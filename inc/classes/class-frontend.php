<?php
/**
 * The Frontend class handles actions and filters that are needed for running on
 * the frontend of a website.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use WP;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Frontend.
 */
class Frontend {

	use Singleton;

	/**
     * Inline CSS limit.
     *
     * @since 1.0.0
     */
    protected const INLINE_CSS_LIMIT = 50000;

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
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets']);
        add_action('parse_request', [$this, 'parseRequest']);
        add_filter('styles_inline_size_limit', [$this, 'filterInlineStylesLimit']);
        add_filter('body_class', [$this, 'filterBodyClass']);
        add_filter('wp_required_field_message', [$this, 'filterRequiredFieldMessage']);

        // Disable the emoji script.
        remove_action('wp_head', 'print_emoji_detection_script', 7);
	}

	/**
     * Enqueue scripts/styles for the front end.
     *
     * @since 1.0.0
     */
    public function enqueueAssets(): void
    {
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
     * Sets the `paged` query var for paginated Query Loop blocks.
     *
     * @since 1.0.0
     */
    public function parseRequest(WP $wp): void
    {
        $page = $this->getQueryBlockPage();

        if (1 < $page) {
            $wp->query_vars['paged'] = $page;
        }
    }

    /**
     * Gets the current page number for paginated Query Loop blocks.
     *
     * @since 1.0.0
     */
    private function getQueryBlockPage(): int
    {
        // Get the URL query for the requested URI.
        $request = isset($_SERVER['REQUEST_URI'])
            ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI']))
            : '';

        $query = wp_parse_url($request, PHP_URL_QUERY);

        // Bail early if this is not a paginated page.
        if (
            !$query
            || !str_contains($query, 'query-')
            || !str_contains($query, 'page=')
        ) {
            return 0;
        }

        // Checks for `?query-page={x}` and `query-{x}-page={y}`.
        preg_match('#query-([0-9]\d*-)?page=([0-9]\d*)#i', $query, $matches);

        return isset($matches[2]) ? absint($matches[2]) : 0;
    }

    /**
     * Custom inline CSS size limit.
     *
     * @since 1.0.0
     */
    public function filterInlineStylesLimit(int $total_inline_limit): int
    {
        return self::INLINE_CSS_LIMIT > $total_inline_limit
            ? self::INLINE_CSS_LIMIT
            : $total_inline_limit;
    }

    /**
     * Adds the style variation to the body class.
     *
     * @since 1.0.0
     */
    public function filterBodyClass(array $classes): array
    {
        $variation = wp_get_global_settings(['custom', 'variation']);

        if (is_string($variation)) {
            $classes[] = esc_attr(sanitize_key("variation-{$variation}"));
        }

        return $classes;
    }

    /**
     * Replaces the space before the required field indicator with a non-breaking space.
     *
     * @since 1.0.0
     */
    public function filterRequiredFieldMessage(string $message): string
    {
        $indicator = wp_required_field_indicator();

        return str_replace(" {$indicator}", "&nbsp;{$indicator}", $message);
    }
}