<?php

/**
 * Block Bindings Source interface.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Ideas\Contracts;

use WP_Block_Bindings_Registry;

interface BlockBindingSource
{
	/**
	 * Registers the block bindings source.
	 *
	 * @since 1.0.0
	 */
	public function register(WP_Block_Bindings_Registry $bindings): void;
}
