<?php

/**
 * The Templates class is responsible for housing any custom code related to
 * block templates.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Ideas;

use BLOGWHEELS\Ideas\Contracts\Bootable;
use BLOGWHEELS\Ideas\Tools\Hooks\{Filter, Hookable};

class Templates implements Bootable
{
	use Hookable;

	/**
	 * Boots the component, running its actions/filters.
	 *
	 * @since 1.0.0
	 */
	#[\Override]
	public function boot(): void
	{
		$this->hookMethods();
	}

	/**
	 * Customizes the titles of the default template types.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/default_template_types/
	 */
	#[Filter('default_template_types')]
	public function filterTitles(array $types): array
	{
		// Defines custom template titles for the core templates.
		// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
		$titles = [
			'404'        => _x('Error 404',        'Template name', 'blogwheels'),
			'archive'    => _x('Archive',          'Template name', 'blogwheels'),
			'attachment' => _x('Media',            'Template name', 'blogwheels'),
			'author'     => _x('Author Archive',   'Template name', 'blogwheels'),
			'category'   => _x('Category Archive', 'Template name', 'blogwheels'),
			'date'       => _x('Date Archive',     'Template name', 'blogwheels'),
			'home'       => _x('Blog',             'Template name', 'blogwheels'),
			'page'       => _x('Page',             'Template name', 'blogwheels'),
			'single'     => _x('Single Entry',     'Template name', 'blogwheels'),
			'singular'   => _x('Singular',         'Template name', 'blogwheels'),
			'tag'        => _x('Tag Archive',      'Template name', 'blogwheels'),
			'taxonomy'   => _x('Term Archive',     'Template name', 'blogwheels'),
		];
		// phpcs:enable

		// Loop through the custom titles and replace the default titles.
		foreach ($titles as $template => $title) {
			if (isset($types[ $template ])) {
				$types[ $template ]['title'] = $title;
			}
		}

		return $types;
	}

	/**
	 * Adds templates if WordPress hasn't defined them by default.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/default_template_types/
	 */
	#[Filter('default_template_types')]
	public function registerTypes(array $types): array
	{
		$types['audio'] ??= [
			'title'       => _x('Media: Audio', 'Template name', 'blogwheels'),
			'description' => __('Displays when a visitor views the dedicated page that exists for an audio attachment.', 'blogwheels'),
		];

		$types['image'] ??= [
			'title'       => _x('Media: Image', 'Template name', 'blogwheels'),
			'description' => __('Displays when a visitor views the dedicated page that exists for an image attachment.', 'blogwheels'),
		];

		$types['single-post'] ??= [
			'title'       => _x('Single Post', 'Template name', 'blogwheels'),
			'description' => __('Displays single posts on your website unless a custom template has been applied to that post or a more specific template exists.', 'blogwheels'),
		];

		$types['video'] ??= [
			'title'       => _x('Media: Video', 'Template name', 'blogwheels'),
			'description' => __('Displays when a visitor views the dedicated page that exists for a video attachment.', 'blogwheels'),
		];

		// The below adds post format support for taxonomy term archive
		// and single post templates. It maintains support for the Core
		// WP naming for term archives but adds a cleaner version as
		// well. The single templates are not supported by WP by default
		// without a filter.
		$types['taxonomy-post-format'] ??= [
			'title'       => _x('Post Format Archive', 'Template Name', 'blogwheels'),
			'description' => __('Displays a post format archive. This template will serve as a fallback when a more specific template (e.g. Post Format: Image) cannot be found.', 'blogwheels')
		];

		$types['taxonomy-post_format'] ??= [
			'title'       => _x('Post Format Archive', 'Template Name', 'blogwheels'),
			'description' => __('Displays a post format archive. This template will serve as a fallback when a more specific template (e.g. Post Format: Image) cannot be found.', 'blogwheels')
		];

		foreach (get_post_format_strings() as $format => $label) {
			$types["single-post-format-{$format}"] ??= [
				// Translators: %s is the post format name.
				'title'       => sprintf(_x('Single Post: %s', 'Template name', 'blogwheels'), $label),
				// Translators: %s is the post format name.
				'description' => sprintf(__('Displays single %s posts on your website unless a custom template has been applied to that post.', 'blogwheels'), $label)
			];

			$types["taxonomy-post-format-{$format}"] ??= [
				// Translators: %s is the post format name.
				'title'       => sprintf(_x('Post Format Archive: %s', 'Template Name', 'blogwheels'), $label),
				// Translators: %s is the post format name.
				'description' => sprintf(__('Displays an archive of %s posts.', 'blogwheels'), $label)
			];

			// Original core templates in case taxonomy template filter is removed.
			$types["taxonomy-post_format-post-format-{$format}"] ??= [
				// Translators: %s is the post format name.
				'title'       => sprintf(_x('Post Format Archive: %s', 'Template Name', 'blogwheels'), $label),
				// Translators: %s is the post format name.
				'description' => sprintf(__('Displays an archive of %s posts.', 'blogwheels'), $label)
			];
		}

		return $types;
	}

	/**
	 * Adds post format support for single post templates.
	 *
	 * @since 1.0.0
	 */
	#[Filter('single_template_hierarchy', 'last')]
	public function singleTemplateHierarchy(array $templates): array
	{
		$post = get_queried_object();

		if (! post_type_supports($post->post_type, 'post-formats')) {
			return $templates;
		}

		$templates    = [];
		$custom       = get_page_template_slug($post);
		$name_decoded = urldecode($post->post_name);
		$post_format  = get_post_format($post);

		if ($custom && 0 === validate_file($custom)) {
			$templates[] = $custom;
		}

		if ($name_decoded !== $post->post_name) {
			$templates[] = "single-{$post->post_type}-{$name_decoded}.php";
		}

		$templates[] = "single-{$post->post_type}-{$post->post_name}.php";

		// @todo - Do we want to allow for format templates based on type?
		if ($post_format) {
			$templates[] = "single-post-format-{$post_format}.php";
		}

		$templates[] = "single-{$post->post_type}.php";
		$templates[] = 'single.php';

		return $templates;
	}

	/**
	 * Cleans up post format term archive template names.
	 *
	 * @since 1.0.0
	 */
	#[Filter('taxonomy_template_hierarchy', 'last')]
	public function taxonomyTemplateHierarchy(array $templates): array
	{
		$term = get_queried_object();

		if (empty($term->slug) || 'post_format' !== $term->taxonomy) {
			return $templates;
		}

		$slug = str_replace('post-format-', '', $term->slug);

		if (in_array($slug, get_post_format_slugs(), true)) {
			$templates = [
				"taxonomy-post-format-{$slug}.php",
				"taxonomy-{$term->taxonomy}-{$term->slug}.php", // Old formatting.
				'taxonomy-post-format.php',
				"taxonomy-{$term->taxonomy}.php", // Old formatting.
				'taxonomy.php'
			];
		}

		return $templates;
	}
}
