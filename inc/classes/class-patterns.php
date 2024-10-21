<?php
/**
 * The Block Patterns class is responsible for registering block pattern
 * categories and block patterns. However, it's recommended to register patterns
 * by placing individual files in the `/patterns` folder.
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
 * Class Patterns.
 */
class Patterns {

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

		// Register WordPress hooks in the constructor.
		add_action('after_setup_theme', [$this, 'removeCoreBlockPatterns']);
		add_action('init', [$this, 'registerCategories'], 5);
	}

	/**
	 * Removes theme support for core block patterns.
	 *
	 * @since 1.0.0
	 */
	public function removeCoreBlockPatterns(): void
	{
		remove_theme_support('core-block-patterns');
	}

	/**
	 * Register block pattern categories.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 */
	public function registerCategories(): void
	{
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
}