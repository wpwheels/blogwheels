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

namespace BLOGWHEELS\Inc;

use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.s
defined('ABSPATH') || exit;

/**
 * Class Templates.
 */
class Templates {

	use Singleton;

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

		// Register filters and actions
		add_filter('default_template_types', [$this, 'filterTitles']);
		add_filter('default_template_types', [$this, 'registerTypes']);
		add_filter('single_template_hierarchy', [$this, 'singleTemplateHierarchy'], 100);
		add_filter('taxonomy_template_hierarchy', [$this, 'taxonomyTemplateHierarchy'], 100);
	}

	/**
	 * Customizes the titles of the default template types.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/default_template_types/
	 */
	public function filterTitles(array $types): array
	{
		$titles = [
			'404'        => _x('Error 404', 'Template name', 'blogwheels'),
			'archive'    => _x('Archive', 'Template name', 'blogwheels'),
			'attachment' => _x('Media', 'Template name', 'blogwheels'),
			'author'     => _x('Author Archive', 'Template name', 'blogwheels'),
			'category'   => _x('Category Archive', 'Template name', 'blogwheels'),
			'date'       => _x('Date Archive', 'Template name', 'blogwheels'),
			'home'       => _x('Blog', 'Template name', 'blogwheels'),
			'page'       => _x('Page', 'Template name', 'blogwheels'),
			'single'     => _x('Single Entry', 'Template name', 'blogwheels'),
			'singular'   => _x('Singular', 'Template name', 'blogwheels'),
			'tag'        => _x('Tag Archive', 'Template name', 'blogwheels'),
			'taxonomy'   => _x('Term Archive', 'Template name', 'blogwheels'),
		];

		// Replace default titles with custom ones
		foreach ($titles as $template => $title) {
			if (isset($types[$template])) {
				$types[$template]['title'] = $title;
			}
		}

		return $types;
	}

	/**
	 * Adds custom template types if WordPress hasn't defined them by default.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/hooks/default_template_types/
	 */
	public function registerTypes(array $types): array
	{
		$types['audio'] ??= [
			'title'       => _x('Media: Audio', 'Template name', 'blogwheels'),
			'description' => __('Displays when a visitor views the dedicated page for an audio attachment.', 'blogwheels'),
		];

		$types['image'] ??= [
			'title'       => _x('Media: Image', 'Template name', 'blogwheels'),
			'description' => __('Displays when a visitor views the dedicated page for an image attachment.', 'blogwheels'),
		];

		$types['single-post'] ??= [
			'title'       => _x('Single Post', 'Template name', 'blogwheels'),
			'description' => __('Displays single posts on your website unless a custom template has been applied or a more specific template exists.', 'blogwheels'),
		];

		$types['video'] ??= [
			'title'       => _x('Media: Video', 'Template name', 'blogwheels'),
			'description' => __('Displays when a visitor views the dedicated page for a video attachment.', 'blogwheels'),
		];

		// Adding post format support for taxonomy term archive and single post templates.
		$types['taxonomy-post-format'] ??= [
			'title'       => _x('Post Format Archive', 'Template Name', 'blogwheels'),
			'description' => __('Displays a post format archive when no specific template exists.', 'blogwheels'),
		];

		$types['taxonomy-post_format'] ??= [
			'title'       => _x('Post Format Archive', 'Template Name', 'blogwheels'),
			'description' => __('Displays a post format archive when no specific template exists.', 'blogwheels'),
		];

		// Loop through post format strings to create specific templates
		foreach (get_post_format_strings() as $format => $label) {
			$types["single-post-format-{$format}"] ??= [
				'title'       => sprintf(_x('Single Post: %s', 'Template name', 'blogwheels'), $label),
				'description' => sprintf(__('Displays single %s posts unless a custom template is applied.', 'blogwheels'), $label),
			];

			$types["taxonomy-post-format-{$format}"] ??= [
				'title'       => sprintf(_x('Post Format Archive: %s', 'Template Name', 'blogwheels'), $label),
				'description' => sprintf(__('Displays an archive of %s posts.', 'blogwheels'), $label),
			];

			// Core WP naming for term archives.
			$types["taxonomy-post_format-post-format-{$format}"] ??= [
				'title'       => sprintf(_x('Post Format Archive: %s', 'Template Name', 'blogwheels'), $label),
				'description' => sprintf(__('Displays an archive of %s posts.', 'blogwheels'), $label),
			];
		}

		return $types;
	}

	/**
	 * Adds post format support for single post templates.
	 *
	 * @since 1.0.0
	 */
	public function singleTemplateHierarchy(array $templates): array
	{
		$post = get_queried_object();

		if (!post_type_supports($post->post_type, 'post-formats')) {
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
				"taxonomy-{$term->taxonomy}-{$term->slug}.php",
				'taxonomy-post-format.php',
				"taxonomy-{$term->taxonomy}.php",
				'taxonomy.php',
			];
		}

		return $templates;
	}
}
