<?php
/**
 * The Editor class handles actions and filters that are needed for running
 * when the block editor is in use. This is primarily needed for enqueueing
 * scripts and styles.
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use BLOGWHEELS\Inc\Helpers\Font_Face_Resolver;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Editor.
 */
class Editor {

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

		/**
		 * Actions.
		 */
		add_action('load-site-editor.php', [$this, 'loadSiteEditor']);
		add_action('after_setup_theme', [$this, 'addEditorStyles']);
		add_action('enqueue_block_editor_assets', [$this, 'enqueueAssets']);
		add_filter('block_editor_settings_all', [$this, 'registerSettings'], 10);
	}

	/**
	 * Runs actions only when viewing the Site Editor screen.
	 *
	 * @since 1.0.0
	 */
	public function loadSiteEditor(): void
	{
		add_action('enqueue_block_assets', [$this, 'enqueueFonts']);
	}

	/**
	 * Add editor stylesheets.
	 *
	 * @since 1.0.0
	 * @link  https://developer.wordpress.org/reference/functions/add_editor_style/
	 */
	public function addEditorStyles(): void
	{
		add_editor_style([
			get_parent_theme_file_uri('public/css/screen.css')
		]);
	}

	/**
	 * Loads editor assets.
	 *
	 * @since 1.0.0
	 */
	public function enqueueAssets(): void
	{
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
	 * Enqueues local web fonts. This is necessary to fix the broken Site
	 * Editor preview with style variations in WordPress.
	 *
	 * @since 1.0.0
	 * @link  https://github.com/WordPress/gutenberg/issues/59965
	 */
	public function enqueueFonts(): void
	{
		ob_start();
		wp_print_font_faces(Font_Face_Resolver::getFonts());
		$content = ob_get_clean();

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style('blogwheels-fonts', false);

		// In this case, we specifically want to use `strip_tags()`.
		// `wp_strip_all_tags()` will remove all the inner content from
		// the `<style>` tag.
		//
		// phpcs:ignore WordPress.WP.AlternativeFunctions.strip_tags_strip_tags
		wp_add_inline_style('blogwheels-fonts', trim(strip_tags($content)));

		wp_enqueue_style('blogwheels-fonts');
	}

	/**
	 * Customizes the block editor settings.
	 *
	 * @since 1.0.0
	 */
	public function registerSettings(array $settings): array
	{
		$settings['imageDefaultSize']   = 'blockwheels-wide';
		$settings['fontLibraryEnabled'] = false;

		return $settings;
	}
}
