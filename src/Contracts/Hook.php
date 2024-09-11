<?php

/**
 * Hook interface.
 *
 * Defines the contract that hook classes should utilize. Hook classes should
 * have a `register()` method with the purpose of registering an action or
 * filter in WordPress.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Contracts;

interface Hook
{
	/**
	 * Bootstraps the class.
	 *
	 * @since 1.0.0
	 */
	public function register(callable $method, int $arguments = 1): void;
}
