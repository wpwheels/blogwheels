<?php
/**
 * The Block Template Parts class is responsible for housing any custom code
 * related to template parts.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Parts.
 */
class Parts {

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

		// Register WordPress hooks and filters here
		add_filter('default_wp_template_part_areas', [$this, 'registerAreas']);
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
	public function registerAreas(array $areas): array
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
}
