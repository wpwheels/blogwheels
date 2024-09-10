<?php

/**
 * The Theme class is a simple container used to store and reference the various
 * theme components. It doesn't support automatic dependency injection (manual
 * only) because it would be overkill for this project.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Ideas;

use WP_Block_Bindings_Registry;
use WP_Block_Patterns_Registry;
use WP_Block_Pattern_Categories_Registry;
use WP_Block_Styles_Registry;
use WP_Block_Type_Registry;
use BLOGWHEELS\Ideas\Block;
use BLOGWHEELS\Ideas\Contracts\Bootable;
use BLOGWHEELS\Ideas\Views\Engine;

class Theme implements Bootable
{
	/**
	 * Stored definitions of single instances.
	 *
	 * @since 1.0.0
	 * @var   mixed[]
	 */
	private array $instances = [];

	/**
	 * Sets up the object state.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->registerDefaultBindings();
	}

	/**
	 * Boots the component by calling bootable bindings.
	 *
	 * @since 1.0.0
	 */
	#[\Override]
	public function boot(): void
	{
		array_walk(
			$this->instances,
			fn($binding) => $binding instanceof Bootable && $binding->boot()
		);
	}

	/**
	 * Registers the default bindings we need to run the theme.
	 *
	 * @since 1.0.0
	 */
	private function registerDefaultBindings(): void
	{
		$this->instance('block.bindings', new Block\Bindings\Component(
			WP_Block_Bindings_Registry::get_instance(),
			[
				Block\Bindings\Comment::class,
				Block\Bindings\Media::class,
				Block\Bindings\Post::class,
				Block\Bindings\Site::class,
				Block\Bindings\Theme::class
			]
		));

		$this->instance('block.render', new Block\Render(
			new Block\Rules(),
			new Engine()
		));

		$this->instance('block.style.variations', new Block\StyleVariations(
			WP_Block_Styles_Registry::get_instance()
		));

		$this->instance('patterns', new Patterns(
			WP_Block_Patterns_Registry::get_instance(),
			WP_Block_Pattern_Categories_Registry::get_instance(),
			WP_Block_Type_Registry::get_instance()
		));

		// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
		$this->instance('block.assets',     new Block\Assets());
		$this->instance('block.metadata',   new Block\Metadata());
		$this->instance('block.variations', new Block\Variations());
		$this->instance('editor',           new Editor());
		$this->instance('embeds',           new Embeds());
		$this->instance('frontend',         new Frontend());
		$this->instance('media',            new Media());
		$this->instance('parts',            new Parts());
		$this->instance('templates',        new Templates());
		// phpcs:enable
	}

	/**
	 * Registers a single instance of a binding. Note that this is marked as
	 * a `private` method for now since this class is meant to be used
	 * internally only.
	 *
	 * @since 1.0.0
	 */
	private function instance(string $abstract, mixed $instance): void
	{
		$this->instances[ $abstract ] = $instance;
	}

	/**
	 * Returns a binding or `null`.
	 *
	 * @since 1.0.0
	 */
	public function get(string $abstract): mixed
	{
		return $this->has($abstract) ? $this->instances[ $abstract ] : null;
	}

	/**
	 * Checks if a binding exists.
	 *
	 * @since 1.0.0
	 */
	public function has(string $abstract): bool
	{
		return isset($this->instances[ $abstract ]);
	}
}
