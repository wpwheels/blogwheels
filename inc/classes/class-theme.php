<?php
/**
 * Bootstraps the Theme.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use WP_Block_Bindings_Registry;
use WP_Query;
use BLOGWHEELS\Inc\Blocks\Assets;
use BLOGWHEELS\Inc\Blocks\Metadata;

use BLOGWHEELS\Inc\Blocks\Style_Variations;
use BLOGWHEELS\Inc\Blocks\Variations;
use BLOGWHEELS\Inc\Blocks\Media;
use BLOGWHEELS\Inc\Blocks\Render;
use BLOGWHEELS\Inc\Blocks\Comment;


use BLOGWHEELS\Inc\Helpers\Utils;


# Prevent direct access.
defined('ABSPATH') || exit;

class Theme {


	/**
	 * Map of keys to their associated methods.
	 *
	 * @since 1.0.0
	 * @todo  Type hint with PHP 8.3+ requirement.
	 */
	private const KEY_METHODS = [
		'name'              => 'renderName',
		'url'               => 'renderUrl',
		'link'              => 'renderLink',
		'superpower'        => 'renderSuperpower',
		'helloDolly'        => 'renderHelloDolly',
		'paginationLabel'   => 'renderPaginationLabel'
	];

	public function __construct() {



		Utils::get_instance();
		Hooks::get_instance();
		Frontend::get_instance();
		Editor::get_instance();
		Embeds::get_instance();
		Media::get_instance();
		Parts::get_instance();
		Patterns::get_instance();
		Templates::get_instance();
		Assets::get_instance();
		Metadata::get_instance();
		Render::get_instance();
		Style_Variations::get_instance();
		Variations::get_instance();
		Comment::get_instance();


		$this->setup_hooks();
	}

	private function setup_hooks() {

		// Register the block binding using WordPress hooks.
        add_action('init', [$this, 'registerBindings']);
		add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );

	}

	/**
     * Registers the block binding with the registry.
     *
     * @since 1.0.0
     */
    public function registerBindings(): void
    {
        $bindings = WP_Block_Bindings_Registry::get_instance();

        // Register a new binding
        $bindings->register('custom/block-data', [
            'label'              => __('Custom Block Data', 'textdomain'),
            'get_value_callback' => [$this, 'get_block_data'],
            'uses_context'       => ['postId', 'userId']
        ]);
    }

	/**
     * Callback to get the custom block data.
     *
     * @param array    $args  Array of arguments passed from the block.
     * @param WP_Block $block The block object.
     * @param string   $name  The block name.
     * @return mixed          The data to be returned to the block.
     */
    public function get_block_data(array $args, WP_Block $block, string $name) {
        // Process block data based on arguments and context
        if (isset($args['key']) && isset(self::KEY_METHODS[$args['key']])) {
            $method = self::KEY_METHODS[$args['key']];
            return $this->$method($args, $block);
        }

        return null;
    }

	/**
     * Returns the theme name.
     *
     * @since 1.0.0
     */
    private function renderName(): string
    {
        return esc_html(wp_get_theme(get_template())->display('Name'));
    }

	/**
     * Returns the theme URL.
     *
     * @since 1.0.0
     */
    private function renderUrl(): string
    {
        $url = wp_get_theme(get_template())->display('ThemeURI');
        return $url ? esc_url($url) : '';
    }

	/**
     * Returns the theme link.
     *
     * @since 1.0.0
     */
    private function renderLink(): string
    {
        if ($url = $this->renderUrl()) {
            return sprintf(
                '<a href="%s" class="theme-name theme-name--link">%s</a>',
                esc_url($url),
                esc_html($this->renderName())
            );
        }

        return sprintf(
            '<span class="theme-name">%s</span>',
            esc_html($this->renderName())
        );
    }

	/**
     * Returns a randomly-generated "powered by" message.
     *
     * @since 1.0.0
     */
    private function renderSuperpower(array $args): string
    {
		return esc_html(Utils::text($args['type'] ?? ''));
        return esc_html((new Superpower())->text($args['type'] ?? ''));
    }

	/**
     * Returns a random lyric from the Hello Dolly plugin if available.
     *
     * @since 1.0.0
     */
    private function renderHelloDolly(): ?string
    {
        if (function_exists('hello_dolly_get_lyric')) {
            return esc_html(sprintf(
                // Translators: %s is a lyric from the Hello Dolly plugin.
                __('🎺 🎶 %s', 'blogwheels'),
                hello_dolly_get_lyric()
            ));
        }

        return null;
    }

	/**
     * Returns a pagination label: "Page 00 / 00". This is intended to be
     * used within the Query Pagination block.
     *
     * @since 1.0.0
     */
    private function renderPaginationLabel(array $args, WP_Block $block): ?string
    {
        // Bail early if there's no query.
        if (!isset($block->context['query'])) {
            return null;
        }

        $query = $block->context['query']['inherit'] ? $GLOBALS['wp_query'] : false;

        // If this is a custom query.
        if (!$query) {
            $key = isset($block->context['queryId'])
                ? "query-{$block->context['queryId']}-page="
                : 'query-page=';

            // Get the URL query for the requested URI.
            $request = isset($_SERVER['REQUEST_URI'])
                ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI']))
                : '';

            $query = wp_parse_url($request, PHP_URL_QUERY);

            // Get the page number.
            $page = $query && str_contains($query, $key)
                ? absint(str_replace($key, '', $query))
                : 1;

            // Build query variables from the block.
            $query = new WP_Query(
                build_query_vars_from_query_block($block, $page)
            );

            // Reset the global post data.
            wp_reset_postdata();
        }

        // Get the max number of pages and digit count for padding with
        // leading zeroes.
        $max = $query->max_num_pages;
        $pad = 0 !== $max ? absint(floor(log10($max) + 1)) : 1;

        // Bail if there's not more than one page.
        if (1 >= $max) {
            return null;
        }

        // Get the current page and pad it with leading zeroes to match
        // the max number of pages.
        $page ??= $query->query_vars['paged'] > 0 ? $query->query_vars['paged'] : 1;
        $page = str_pad(strval($page), $pad, "0", STR_PAD_LEFT);

        return sprintf(
            // Translators: 1 is the current page, 2 is the total pages.
            __('Page %1$s / %2$s:', 'blogwheels'),
            esc_html($page), // This is a padded string.
            absint($max)
        );
    }





	/**
	 * Setup theme.
	 *
	 * @return void
	 */
	public function setup_theme() {

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Custom logo.
		 *
		 * @see Adding custom logo
		 * @link https://developer.wordpress.org/themes/functionality/custom-logo/#adding-custom-logo-support-to-your-theme
		 */
		add_theme_support(
			'custom-logo',
			[
				'header-text' => [
					'site-title',
					'site-description',
				],
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			]
		);

		/**
		 * Adds Custom background panel to customizer.
		 *
		 * @see Enable Custom Backgrounds
		 * @link https://developer.wordpress.org/themes/functionality/custom-backgrounds/#enable-custom-backgrounds
		 */
		add_theme_support(
			'custom-background',
			[
				'default-color' => 'ffffff',
				'default-image' => '',
				'default-repeat' => 'no-repeat',
			]
		);

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * Adding this will allow you to select the featured image on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );


		/**
		 * Register image sizes.
		 */
		//add_image_size( 'featured-thumbnail', 350, 233, true );


		// Add theme support for selective refresh for widgets.
		/**
		 * WordPress 4.5 includes a new Customizer framework called selective refresh
		 *
		 * Selective refresh is a hybrid preview mechanism that has the performance benefit of not having to refresh the entire preview window.
		 *
		 * @link https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Switch default core markup for search form, comment form, comment-list, gallery, caption, script and style
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		// Gutenberg theme support.

		/**
		 * Some blocks in Gutenberg like tables, quotes, separator benefit from structural styles (margin, padding, border etc…)
		 * They are applied visually only in the editor (back-end) but not on the front-end to avoid the risk of conflicts with the styles wanted in the theme.
		 * If you want to display them on front to have a base to work with, in this case, you can add support for wp-block-styles, as done below.
		 * @see Theme Styles.
		 * @link https://make.wordpress.org/core/2018/06/05/whats-new-in-gutenberg-5th-june/, https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles
		 */
		add_theme_support( 'wp-block-styles' );

		/**
		 * Some blocks such as the image block have the possibility to define
		 * a “wide” or “full” alignment by adding the corresponding classname
		 * to the block’s wrapper ( alignwide or alignfull ). A theme can opt-in for this feature by calling
		 * add_theme_support( 'align-wide' ), like we have done below.
		 *
		 * @see Wide Alignment
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Loads the editor styles in the Gutenberg editor.
		 *
		 * Editor Styles allow you to provide the CSS used by WordPress’ Visual Editor so that it can match the frontend styling.
		 * If we don't add this, the editor styles will only load in the classic editor ( tiny mice )
		 *
		 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
		 */
		add_theme_support( 'editor-styles' );
		/**
		 *
		 * Path to our custom editor style.
		 * It allows you to link a custom stylesheet file to the TinyMCE editor within the post edit screen.
		 *
		 * Since we are not passing any parameter to the function,
		 * it will by default, link the editor-style.css file located directly under the current theme directory.
		 * In our case since we are passing 'build/css/editor.css' path it will use that.
		 * You can change the name of the file or path and replace the path here.
		 *
		 * @see add_editor_style(
		 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
		 */
		add_editor_style( 'build/css/editor.css' );

		// Remove the core block patterns
		remove_theme_support( 'core-block-patterns' );

	}

}
