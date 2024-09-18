<?php
/**
 * Embed filters and actions.
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Embeds.
 */
class Embeds {

	use Singleton;

	/**
     * Image size to use for featured images.
     *
     * @since 1.0.0
     */
    protected const IMAGE_SIZE = 'blockwheels-wide';

    /**
     * Image shape to use for featured images (`rectangular` or `square`).
     *
     * @since 1.0.0
     */
    protected const IMAGE_SHAPE = 'rectangular';

    /**
     * Maximum number of words in the excerpt.
     *
     * @since 1.0.0
     */
    protected const EXCERPT_LENGTH = 24;

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

		// Register actions and filters.
        add_action('enqueue_embed_scripts', [$this, 'enqueueAssets']);
        add_filter('embed_thumbnail_image_size', [$this, 'filterImageSize']);
        add_filter('embed_thumbnail_image_shape', [$this, 'filterImageShape']);
        add_filter('excerpt_length', [$this, 'filterExcerptLength']);
        add_filter('excerpt_more', [$this, 'filterExcerptMore']);
        add_filter('embed_site_title_html', [$this, 'filterSiteTitleHtml']);
	}

	/**
     * Loads assets needed for the embed.
     *
     * @since 1.0.0
     */
    public function enqueueAssets(): void
    {
        $embed_styles = file_get_contents(get_parent_theme_file_path('public/css/embed.css'));
        $style_asset  = include get_parent_theme_file_path('public/css/embed.asset.php');

        // Register an empty stylesheet so that inline styles can piggyback off it.
        wp_register_style(
            'blogwheels-embed',
            false,
            ['wp-embed-template'],
            $style_asset['version']
        );

        // Add inline styles.
        wp_add_inline_style('blogwheels-embed', wp_get_global_stylesheet());
        wp_add_inline_style('blogwheels-embed', $embed_styles);

        // Enqueue the embed style.
        wp_enqueue_style('blogwheels-embed');
    }

    /**
     * Replaces the default size with our custom image size.
     *
     * @since 1.0.0
     */
    public function filterImageSize(): string
    {
        return self::IMAGE_SIZE;
    }

    /**
     * Ensures that the featured image shape is set to match our size.
     *
     * @since 1.0.0
     */
    public function filterImageShape(): string
    {
        return self::IMAGE_SHAPE;
    }

    /**
     * Adds a custom excerpt length for embeds.
     *
     * @since 1.0.0
     */
    public function filterExcerptLength(int $number): int
    {
        return is_embed() ? self::EXCERPT_LENGTH : $number;
    }

    /**
     * Adds a custom excerpt more string for embeds.
     *
     * @since 1.0.0
     */
    public function filterExcerptMore(string $more_string): string
    {
        return is_embed() ? '&thinsp;&hellip;' : $more_string;
    }

    /**
     * Overwrites the embed site title HTML if the site doesn't have a custom icon.
     *
     * @since 1.0.0
     */
    public function filterSiteTitleHtml(string $site_title): string
    {
        // Bail if the site has an icon.
        if (get_site_icon_url()) {
            return $site_title;
        }

        return sprintf(
            '<div class="wp-embed-site-title">
                <a href="%s" target="_top">%s<span>%s</span></a>
            </div>',
            esc_url(home_url()),
            block_core_social_link_get_icon('wordpress'),
            esc_html(get_bloginfo('name'))
        );
    }
}