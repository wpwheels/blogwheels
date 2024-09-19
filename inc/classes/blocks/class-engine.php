<?php
/**
 * The view engine is designed to make using the `View` class easy and stands as
 * a wrapper for quickly getting or rendering a view.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc\Blocks;

use WP_Block;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Engine.
 */
class Engine
{
	use Singleton;

	/**
	 * Returns a new view.
	 *
	 * @since 1.0.0
	 */
	public function view(string $name, array $data = []): View
	{
		return new View($name, $data);
	}

	/**
	 * Returns the first found view or `false`.
	 *
	 * @since 1.0.0
	 */
	public function any(array|string $views, array $data = []): View|false
	{
		foreach ((array) $views as $view) {
			if ($this->exists($view)) {
				return $this->view($view, $data);
			}
		}

		return false;
	}

	/**
	 * Renders a view only if it exists.
	 *
	 * @since 1.0.0
	 */
	public function renderIf(array|string $views, array $data = []): string
	{
		$view = $this->any((array) $views, $data);

		return $view ? $view->render() : '';
	}

	/**
	 * Renders a view when `$when` is `true`.
	 *
	 * @since 1.0.0
	 */
	public function renderWhen(
		mixed $when,
		array|string $views,
		array $data = []
	): string {
		return $when ? $this->renderIf($views, $data) : '';
	}

	/**
	 * Renders a view unless `$unless` is `true`.
	 *
	 * @since 1.0.0
	 */
	public function renderUnless(
		mixed $unless,
		array|string $views,
		array $data = []
	): string {
		return ! $unless ? $this->renderIf($views, $data) : '';
	}

	/**
	 * Checks if a view exists.
	 *
	 * @since 1.0.0
	 */
	public function exists(string $name): bool
	{
		$basename   = str_replace('.', '/', $name);
		$stylesheet = get_stylesheet_directory() . "/views/{$basename}.php";
		$template   = get_template_directory() . "/views/{$basename}.php";

		if (! is_child_theme()) {
			return file_exists($template);
		}

		return file_exists($stylesheet) ?: file_exists($template);
	}
}