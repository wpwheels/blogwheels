<?php
/**
 * Enqueue theme assets.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use FilesystemIterator;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Assets.
 */
class Assets {

	use Singleton;

	/**
	 * Stores the supported block namespaces that we use for block stylesheets.
	 *
	 * @since 1.0.0
	 * @var   string[]
	 * @todo  Type hint with PHP 8.3+ requirement.
	 */
	protected const NAMESPACES = [
		'core'
	];

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

		/**
		 * Actions.
		 */
		add_action( 'init', [ $this, 'enqueue_assets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_assets' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'editor_assets' ] );
	}

	/**
	 * Enqueues block-specific styles so that they only load when the block
	 * is in use. Block styles stored under `/assets/css/blocks` are
	 * automatically enqueued. Each file should be named
	 * `{$block_namespace}/{$block_slug}.css`.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
	 */
	public function enqueue_assets() {
		// Loop through each of the block namespace paths, get their
		// stylesheets, and enqueue them.
		foreach (self::NAMESPACES as $namespace) {
			$files = new FilesystemIterator(
				get_parent_theme_file_path("public/css/blocks/{$namespace}")
			);

			foreach ($files as $file) {
				if (! $file->isDir() && 'css' === $file->getExtension()) {
					$this->enqueueStyle(
						$namespace,
						$file->getBasename('.css')
					);
				}
			}
		}
	}

	/**
	 * Enqueue css & js on front-end
	 */
	public function frontend_assets() {

		$asset = include get_parent_theme_file_path('public/css/screen.asset.php');

		// Loads the primary stylesheet.
		wp_enqueue_style(
			'blogwheels-style',
			get_parent_theme_file_uri('public/css/screen.css'),
			$asset['dependencies'],
			$asset['version']
		);
	}

	/**
	 * Enqueue css & js on front-end
	 */
	public function editor_assets() {

		$screen = include get_parent_theme_file_path('public/css/screen.asset.php');

		// Loads the primary stylesheet.
		wp_enqueue_style(
			'blogwheels-style',
			get_parent_theme_file_uri('public/css/screen.css'),
			$screen['dependencies'],
			$screen['version']
		);

		$script_asset = include get_parent_theme_file_path('public/js/editor.asset.php');
		$style_asset  = include get_parent_theme_file_path('public/css/editor.asset.php');

		wp_enqueue_script(
			'blogwheels-editor',
			get_parent_theme_file_uri('public/js/editor.js'),
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);

		wp_enqueue_style(
			'blogwheels-editor',
			get_parent_theme_file_uri('public/css/editor.css'),
			$style_asset['dependencies'],
			$style_asset['version']
		);

		// Set translations for editor scripts.
		// @link https://developer.wordpress.org/reference/functions/wp_set_script_translations/
		wp_set_script_translations('blogwheels-editor', 'blogwheels');
	}

	/**
	 * Enqueues an individual block stylesheet based on a given block
	 * namespace and slug.
	 *
	 * @since 1.0.0
	 */
	private function enqueueStyle(string $namespace, string $slug): void
	{
		// Build a relative path and URL string.
		$relative = "public/css/blocks/{$namespace}/{$slug}";

		// Bail if the asset file doesn't exist.
		if (! file_exists(get_parent_theme_file_path("{$relative}.asset.php"))) {
			return;
		}

		// Get the asset file.
		$asset = include get_parent_theme_file_path("{$relative}.asset.php");

		// Register the block style.
		wp_enqueue_block_style("{$namespace}/{$slug}", [
			'handle' => "blogwheels-block-{$namespace}-{$slug}",
			'src'    => get_parent_theme_file_uri("{$relative}.css"),
			'path'   => get_parent_theme_file_path("{$relative}.css"),
			'deps'   => $asset['dependencies'],
			'ver'    => $asset['version']
		]);
	}
}