<?php

/**
 * The Bindings component registers custom binding sources with the WordPress
 * Block Bindings API.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Block\Bindings;

use WP_Block_Bindings_Registry;
use BLOGWHEELS\Contracts\{BlockBindingSource, Bootable};
use BLOGWHEELS\Inc\Helpers\Hooks\{Action, Hookable};

class Component implements Bootable
{
	use Hookable;

	/**
	 * Sets up the initial object state.
	 *
	 * @since 1.0.0
	 * @param BlockBindingSource[]  $sources
	 */
	public function __construct(
		protected WP_Block_Bindings_Registry $bindings,
		protected array $sources
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
	 * Register custom block bindings sources.
	 *
	 * @since 1.0.0
	 */
	#[Action('init')]
	public function register(): void
	{
		foreach ($this->sources as $source) {
			if (is_subclass_of($source, BlockBindingSource::class)) {
				(new $source())->register($this->bindings);
			}
		}
	}
}
