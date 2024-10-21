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

namespace BLOGWHEELS;

use WP_Block_Patterns_Registry;
use WP_Block_Pattern_Categories_Registry;
use WP_Block_Type_Registry;
use BLOGWHEELS\Contracts\Bootable;
use BLOGWHEELS\Inc\Helpers\Hooks\{Action, Hookable};

class Patterns implements Bootable
{
	use Hookable;

	/**
	 * Sets up the object state.
	 *
	 * @since 1.0.0
	 */
	public function __construct(
		protected WP_Block_Patterns_Registry $patterns,
		protected WP_Block_Pattern_Categories_Registry $categories,
		protected WP_Block_Type_Registry $block_types
	) {}

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
	 * Removes theme support for core patterns.
	 *
	 * @since 1.0.0
	 */
	#[Action('after_setup_theme')]
	public function themeSupport(): void
	{
		remove_theme_support('core-block-patterns');
	}

	/**
	 * Register block pattern categories. Note that this theme registers
	 * patterns by adding them as individual pattern files in the `/patterns`
	 * folder.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 */
	#[Action('init', 'first')]
	public function registerCategories(): void
	{
		$this->categories->register('blockwheels-card', [
			'label'       => __('Cards', 'blogwheels'),
			'description' => __('A variety of card-based designs.', 'blogwheels')
		]);

		$this->categories->register('blockwheels-grid', [
			'label'       => __('Grids', 'blogwheels'),
			'description' => __('A variety of designs that group items in a grid layout.', 'blogwheels')
		]);

		$this->categories->register('blockwheels-hero', [
			'label'       => __('Heroes', 'blogwheels'),
			'description' => __('Large, full-width sections that make a statement.', 'blogwheels')
		]);

		$this->categories->register('blockwheels-layout', [
			'label'       => __('Layout', 'blogwheels'),
			'description' => __('Basic building blocks for arranging custom layouts.', 'blogwheels')
		]);
	}
}