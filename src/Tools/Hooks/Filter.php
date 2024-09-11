<?php

/**
 * The filter attribute class is for registering class methods as a filter on a
 * WordPress hook using a PHP attribute.
 *
 *
 * @copyright 2008-2024 WPWheels
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Tools\Hooks;

use Attribute;
use BLOGWHEELS\Contracts\Hook;

#[Attribute(
	Attribute::IS_REPEATABLE
	| Attribute::TARGET_CLASS_CONSTANT
	| Attribute::TARGET_METHOD
	| Attribute::TARGET_PROPERTY
)]
class Filter implements Hook
{
	/**
	 * Sets up the object state.
	 *
	 * @since 1.0.0
	 */
	public function __construct(
		protected string $hook,
		protected int|string $priority = 10
	) {
		$this->priority = match ($this->priority) {
			'first' => PHP_INT_MIN,
			'last'  => PHP_INT_MAX,
			default => intval($this->priority)
		};
	}

	/**
	 * Registers the filter hook.
	 *
	 * @since 1.0.0
	 */
	public function register(callable $method, int $arguments = 1): void
	{
		add_filter($this->hook, $method, intval($this->priority), $arguments);
	}
}
