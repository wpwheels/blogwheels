<?php
/**
 * The Render class handles filters on block rendering.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc\Blocks;

use WP_Block;
use WP_HTML_Tag_Processor;
use FilesystemIterator;
use BLOGWHEELS\Inc\Traits\Singleton;
use BLOGWHEELS\Inc\Blocks\Engine;
use BLOGWHEELS\Inc\Blocks\Rules;
use BLOGWHEELS\Block\Helpers\Code_Highlight;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Render.
 */
class Render {

	use Singleton;

	protected $rules;

	protected $views;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->rules = Rules::get_instance();
		$this->views = Engine::get_instance();
		$this->setup_hooks();
	}

	/**
	 * Initialize hooks.
	 */
	private function setup_hooks() {

		// Hook into WordPress.
        add_filter('pre_render_block', [$this, 'preRenderCorePostExcerpt'], 10, 3);
        add_filter('render_block_data', [$this, 'renderCoreQueryData']);
        add_filter('render_block', [$this, 'renderByRule'], 10, 3);
        add_filter('render_block_core/calendar', [$this, 'renderCoreCalendar']);
        add_filter('render_block_core/code', [$this, 'renderCoreCode'], 10, 2);
        add_filter('render_block_core/cover', [$this, 'renderCoreCover'], 10, 2);
        add_filter('render_block_core/loginout', [$this, 'renderCoreLoginout'], 10, 2);
        add_filter('render_block_core/post-excerpt', [$this, 'renderCorePostExcerpt']);
        add_filter('render_block_core/tag-cloud', [$this, 'renderCoreTagCloud'], 10, 2);
        add_filter('render_block_core/template-part', [$this, 'renderCoreTemplatePart'], 10, 2);
        add_filter('render_block_core/post-content', [$this, 'renderCorePostContent'], 10, 3);
        add_filter('block_core_navigation_listable_blocks', [$this, 'setListItemWrapper']);
        add_filter('widget_archives_args', [$this, 'setWidgetArchivesArgs'], 10, 1);
    }

	/**
	 * Before rendering the Post Excerpt block, add a custom filter to
	 * `wp_trim_words` so that we can handle the output of custom excerpts.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/issues/49449
	 */
	public function preRenderCorePostExcerpt(
		?string $pre_render,
		array $block,
		?WP_Block $parent_block
	): ?string {
		if (
			'core/post-excerpt' === $block['blockName']
			&& is_null($pre_render)
			&& ! is_null($parent_block)
			&& isset($parent_block->context['postId'])
			&& has_excerpt($parent_block->context['postId'])
		) {
			add_filter('wp_trim_words', [$this, 'formatManualExcerpt'], 10, 4);
		}

		return $pre_render;
	}

	/**
	 * Disables the enhanced pagination feature for the Query Loop block.
	 * There is currently no `theme.json`-supported method of disabling it,
	 * so the only method is to filter the block data itself before render.
	 * @link  https://github.com/WordPress/gutenberg/issues/57623
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/render_block_data/
	 */
	public function renderCoreQueryData(array $parsed_block): array
	{
		if ('core/query' === $parsed_block['blockName']) {
			$parsed_block['attrs']['enhancedPagination'] = false;
		}

		return $parsed_block;
	}

	/**
	 * Filters block content, determining if it should be shown according to
	 * any rules passed in via attributes.
	 *
	 * @since 1.0.0
	 */
	public function renderByRule(
		string $content,
		array $block,
		WP_Block $instance
	): string {
		return $this->rules->isPublic($block, $instance) ? $content : '';
	}

	/**
	 * Adds a caption class and replaces nav arrows.
	 *
	 * @since 1.0.0
	 */
	public function renderCoreCalendar(string $content): string
	{
		$processor = new WP_HTML_Tag_Processor($content);

		// Ensures the table caption has the same class as other the
		// other captions in WordPress. The `.wp-element-caption` class
		// is necessary for styling this via `theme.json`.
		if ($processor->next_tag('caption')) {
			$processor->add_class(wp_theme_get_element_class_name('caption'));
		}

		// Hacky method to replace the arrows until the HTML API allows
		// replacing inner text.
		return str_replace(
			[ '&raquo;', '&laquo;' ],
			[ '&rarr;',  '&larr;'  ],
			$processor->get_updated_html()
		);
	}

	/**
	 * Adds Code block highlight functionality and fixes `<br>` tags.
	 *
	 * @since 1.0.0
	 */
	public function renderCoreCode(string $content, array $block): string
	{
		return (new Code_Highlight($content, $block))->render();
	}

	/**
	 * Adds poster support for the Cover block by using the attachment's
	 * featured image if it exists.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/issues/18962
	 */
	public function renderCoreCover(string $content, array $block): string
	{
		if (
			! isset($block['attrs']['backgroundType'])
			|| 'video' !== $block['attrs']['backgroundType']
			|| ! isset($block['attrs']['id'])
			|| ! $poster = get_the_post_thumbnail_url($block['attrs']['id'], 'full')
		) {
			return $content;
		}

		$processor = new WP_HTML_Tag_Processor($content);

		if (
			$processor->next_tag('video')
			&& is_null($processor->get_attribute('poster'))
		) {
			$processor->set_attribute('poster', $poster);
		}

		return $processor->get_updated_html();
	}

	/**
	 * Adds the `.wp-element-button` class to the login form's submit button.
	 * This is currently missing from core WP.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/issues/50466
	 */
	public function renderCoreLoginout(string $content, array $block): string
	{
		if (
			empty($block['attrs']['displayLoginAsForm'])
			|| is_user_logged_in()
		) {
			return $content;
		}

		$processor = new WP_HTML_Tag_Processor($content);

		// Specifically look for `<input name="wp-submit"/>` and add the
		// `.wp-element-button` class to it.
		while ($processor->next_tag()) {
			if (
				'INPUT' === $processor->get_tag()
				&& 'wp-submit' === $processor->get_attribute('name')
			) {
				$processor->add_class(wp_theme_get_element_class_name('button'));
				break;
			}
		}

		return $processor->get_updated_html();
	}

	/**
	 * Removes the filter on `wp_trim_words` if it was added on the earlier
	 * `pre_render_block` hook.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/issues/49449
	 * @see   Render::preRenderCorePostExcerpt()
	 */
	public function renderCorePostExcerpt(string $content): string
	{
		if ($priority = has_filter('wp_trim_words', [$this, 'formatManualExcerpt'])) {
			remove_filter('wp_trim_words', [$this, 'formatManualExcerpt'], $priority);
		}

		return $content;
	}

	/**
	 * WordPress doesn't add the taxonomy name to the tag cloud wrapper. In
	 * order for taxonomy-based block styles to work, the theme is adding
	 * a `.taxonomy-{taxonomy}` class to the wrapper.
	 *
	 * @since 1.0.0
	 */
	public function renderCoreTagCloud(string $content, array $block): string
	{
		$processor = new WP_HTML_Tag_Processor($content);

		if ($processor->next_tag('p')) {
			$processor->add_class(sprintf(
				'taxonomy-%s',
				$block['attrs']['taxonomy'] ?? 'post_tag'
			));
		}

		return $processor->get_updated_html();
	}

	/**
	 * Disables the Comments template part when there are no comments and
	 * commenting is disabled.
	 *
	 * @since 1.0.0
	 */
	public function renderCoreTemplatePart(string $content, array $block): string
	{
		if (
			isset($block['attrs']['slug'])
			&& 'comments' === $block['attrs']['slug']
			&& ! comments_open()
			&& 0 === absint(get_comments_number())
		) {
			return '';
		}

		return $content;
	}

	/**
	 * Filters the post content block when viewing single attachment views
	 * and returns block-based media content.
	 *
	 * @since 1.0.0
	 */
	public function renderCorePostContent(
		string $content,
		array $block,
		WP_Block $instance
	): string {
		// Bail early if there's no post ID or not specifically viewing
		// the attachment page for this specific post.
		if (
			empty($instance->context['postId'])
			|| ! is_attachment($instance->context['postId'])
		) {
			return $content;
		}

		// Assign needed data.
		$post_id = absint($instance->context['postId']);
		$data    = [ 'post_id' => $post_id ];

		// Get the media view names.
		$media = $this->attachmentViewNames(
			'media',
			[ 'video', 'audio', 'pdf' ],
			$post_id
		);

		// Renders the media + block content + meta.
		return $this->views->renderIf($media, $data) . $content;
	}

	/**
	 * Returns the rendered attachment partial.
	 *
	 * @since 1.0.0
	 */
	private function attachmentViewNames(string $name, array $types, int $post_id): array
	{
		foreach ($types as $type) {
			if (wp_attachment_is($type, $post_id)) {
				return [
					"attachment/{$name}-{$type}",
					"attachment/{$name}"
				];
			}
		}

		return [ "attachment-{$name}" ];
	}

	/**
	 * Adds missing wrapping `<li>` to the Loginout block when used in a
	 * navigation menu.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/pull/55551
	 */
	public function setListItemWrapper(array $blocks): array
	{
		return [ 'core/loginout' ] + $blocks;
	}

	/**
	 * Filter on the `widget_archives_args` hook, which is also used in the
	 * Archives block to pass the arguments to the `wp_get_archives()`
	 * function. We're using it here to give a wrapper `<div>` to individual
	 * list items. This provides a bit more design flexibility with custom
	 * block styles.
	 *
	 * @since 1.0.0
	 */
	public function setWidgetArchivesArgs(array $args): array
	{
		$before = $args['before'] ?? '';
		$after  = $args['after'] ?? '';

		$args['before'] = '<div class="wp-block-archives__content">' . $before;
		$args['after']  = $after . '</div>';

		return $args;
	}











	/**
	 * Filters `wp_trim_words` to allow the original text but removes
	 * unwanted tags. This is meant to be used only when the user has
	 * written a custom excerpt.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/issues/49449
	 * @see   Render::preRenderCorePostExcerpt()
	 */
	public function formatManualExcerpt(
		string $text,
		int $num_words,
		string $more,
		string $original_text
	): string {
		return wp_kses($original_text, [
			'a'       => [ 'href' => true, 'title' => true, 'class' => true ],
			'abbr'    => [ 'title' => true ],
			'acronym' => [ 'title' => true ],
			'bold'    => [ 'class' => true ],
			'code'    => [ 'class' => true ],
			'em'      => [ 'class' => true ],
			'i'       => [ 'class' => true ],
			'mark'    => [ 'class' => true ],
			'small'   => [ 'class' => true ],
			'span'    => [ 'class' => true ],
			'strong'  => [ 'class' => true ]
		]);
	}


}