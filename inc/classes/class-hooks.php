<?php
/**
 * Bootstraps the Theme actions and filters.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use WP_Block_Patterns_Registry;
use WP_Block_Pattern_Categories_Registry;
use WP_Block_Type_Registry;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Hooks.
 */
class Hooks {

	use Singleton;

	/**
	 * Patterns that should be conditionally removed if the block is not
	 * registered for the install.
	 *
	 * @since 1.0.0
	 * @todo  Type hint with PHP 8.3+ requirement.
	 */
	protected const CONDITIONAL_PATTERNS = [
		'core/table-of-contents' 	=> [ 'blogwheels/card-table-of-contents' ],
		'blockwheels/breadcrumbs'	=> [ 'blogwheels/breadcrumbs' ]
	];

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->setup_hooks();
	}

	/**
	 * Initialize hooks.
	 */
	private function setup_hooks() {


		/**
		 * Filters and Actions.
		 */
		add_action( 'init', [ $this, 'unregister_conditional_patterns' ] );
		add_action( 'init', [ $this, 'register_pattern_categories' ], 9 );
		add_action( 'default_wp_template_part_areas', [ $this, 'template_part_areas' ] );


		add_filter( 'default_template_types', [ $this, 'filter_titles' ], 10, 1 );
		add_filter( 'default_template_types', [ $this, 'register_block_types' ] );
		add_filter( 'single_template_hierarchy', [ $this, 'single_template_hierarchy_filter' ] );
		add_filter( 'taxonomy_template_hierarchy', [ $this, 'taxonomy_template_hierarchy_filter' ] );
	}

	/**
	 * Unregister block patterns, specifically those that use block types
	 * that are not in use on the site.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/functions/unregister_block_pattern/
	 */
	public function unregister_conditional_patterns(): void {
		$block_registry = WP_Block_Type_Registry::get_instance();
		$pattern_registry = WP_Block_Patterns_Registry::get_instance();

		foreach (self::CONDITIONAL_PATTERNS as $block => $patterns) {
			if (! $block_registry->is_registered($block)) {
				array_walk(
					$patterns,
					fn($pattern) => $pattern_registry->unregister($pattern)
				);
			}
		}
	}

	/**
	 * Register block pattern categories. Note that this theme registers
	 * patterns by adding them as individual pattern files in the `/patterns`
	 * folder.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 */
	public function register_pattern_categories(): void {
		$category_registry = WP_Block_Pattern_Categories_Registry::get_instance();

		$category_registry->register('blockwheels-card', [
			'label'       => __('Cards', 'blogwheels'),
			'description' => __('A variety of card-based designs.', 'blogwheels')
		]);

		$category_registry->register('blockwheels-grid', [
			'label'       => __('Grids', 'blogwheels'),
			'description' => __('A variety of designs that group items in a grid layout.', 'blogwheels')
		]);

		$category_registry->register('blockwheels-hero', [
			'label'       => __('Heroes', 'blogwheels'),
			'description' => __('Large, full-width sections that make a statement.', 'blogwheels')
		]);

		$category_registry->register('blockwheels-layout', [
			'label'       => __('Layout', 'blogwheels'),
			'description' => __('Basic building blocks for arranging custom layouts.', 'blogwheels')
		]);
	}

	/**
	 * Filter the core template part areas to add custom areas needed for
	 * the theme.
	 *
	 * Core only supports four icons at the moment, so the `icon` field
	 * value doesn't actually work. But the value must be defined to avoid
	 * an error.
	 * @link https://github.com/WordPress/gutenberg/issues/36814
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/default_wp_template_part_areas/
	 */
	public function template_part_areas(array $areas): array
	{
		$areas[] = [
			'area'        => 'comments',
			'area_tag'    => 'section',
			'label'       => __('Comments', 'blogwheels'),
			'description' => __('The Comments template part defines an area that contains the comments list and form.', 'blogwheels'),
			'icon'        => 'layout'
		];

		$areas[] = [
			'area'        => 'loop',
			'area_tag'    => 'div',
			'label'       => __('Loop', 'blogwheels'),
			'description' => __('The Loop template part defines an area that contains the post list on blog, search results, and other archive-type pages.', 'blogwheels'),
			'icon'        => 'layout'
		];

		return $areas;
	}

	/**
	 * Customizes the titles of the default template types.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/default_template_types/
	 */
	public function filter_titles(array $types): array
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
	public function register_block_types(array $types): array
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
	public function single_template_hierarchy_filter(array $templates): array
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
	public function taxonomy_template_hierarchy(array $templates): array
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