<?php
/**
 * Media filters and actions.
 *
 * @copyright 2023 WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc;

use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Media.
 */
class Media {

	use Singleton;

	/**
	 * Width size to scale large images down to.
	 *
	 * @since 1.0.0
	 */
	protected const THRESHOLD_WIDTH = 3480;

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

		// Add actions and filters here
		add_action('init', [$this, 'registerImageSizes']);
		add_filter('image_size_names_choose', [$this, 'registerImageSizeNames']);
		add_filter('big_image_size_threshold', [$this, 'filterBigImageThreshold'], 5);
		add_filter('post_thumbnail_size', [$this, 'filterPostThumbnailSize'], 5);
		add_filter('smilies', [$this, 'registerEmoticons']);
	}

	/**
	 * Registers custom image sizes.
	 *
	 * @since 1.0.0
	 */
	public function registerImageSizes(): void
	{
		add_image_size('blockwheels-square',   1024, 1024, true);
		add_image_size('blockwheels-wide',     2048, 1152, true);
		add_image_size('blockwheels-portrait', 1024, 1365, true);
	}

	/**
	 * Filters the image size dropdown in the editor so our custom sizes appear for selection.
	 *
	 * @since 1.0.0
	 */
	public function registerImageSizeNames(array $sizes): array
	{
		return array_merge($sizes, [
			'blockwheels-square'   => __('Square', 'blogwheels'),
			'blockwheels-wide'     => __('Wide', 'blogwheels'),
			'blockwheels-portrait' => __('Portrait', 'blogwheels')
		]);
	}

	/**
	 * Limit the big image threshold to our largest image.
	 *
	 * @since 1.0.0
	 */
	public function filterBigImageThreshold(int $threshold): int
	{
		return self::THRESHOLD_WIDTH > $threshold ? self::THRESHOLD_WIDTH : $threshold;
	}

	/**
	 * Sets the default `post-thumbnail` size to a theme-specific size.
	 *
	 * @since 1.0.0
	 */
	public function filterPostThumbnailSize(string $size): string
	{
		return 'post-thumbnail' === $size ? 'blockwheels-wide' : $size;
	}

	/**
	 * Filters the core emoticon images and replaces `:mrgreen` with a custom SVG.
	 *
	 * @since 1.0.0
	 * @link  https://core.trac.wordpress.org/attachment/ticket/31709/mrgreen.svg
	 */
	public function registerEmoticons(array $smilies): array
	{
		return array_merge($smilies, [
			':mrgreen:' => '<svg class="wp-smiley wp-smiley--mrgreen" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg2" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><g id="g14"><g><defs><rect id="SVGID_1_" y="0" width="30" height="30"/></defs><clipPath id="SVGID_2_"><use xlink:href="#SVGID_1_" overflow="visible"/></clipPath><g id="g16" clip-path="url(#SVGID_2_)"><g id="g22" transform="translate(37,19)"><path id="path24" fill="#51B372" d="M-7.8-4c0,7.8-6.4,14.2-14.2,14.2S-36.2,3.8-36.2-4s6.4-14.2,14.2-14.2S-7.8-11.8-7.8-4"/></g><g id="g26" transform="translate(19,16)"><path id="path28" fill="#1B3A24" d="M-4,1.4c-2.9,0-4.8-0.3-7.1-0.8c-0.5-0.1-1.6,0-1.6,1.6c0,3.2,3.6,7.1,8.7,7.1 c5.1,0,8.7-3.9,8.7-7.1c0-1.6-1-1.7-1.6-1.6C0.8,1-1.1,1.4-4,1.4"/></g><g id="g30" transform="translate(11,24)"><path id="path32" fill="#1B3A24" d="M-2.3-12.9c0,0,0-1.6,1.6-1.6s1.6,1.6,1.6,1.6v1.6c0,0,0,1.6-1.6,1.6s-1.6-1.6-1.6-1.6 V-12.9z"/></g><g id="g34" transform="translate(23,24)"><path id="path36" fill="#1B3A24" d="M-4.8-12.9c0,0,0-1.6,1.6-1.6s1.6,1.6,1.6,1.6v1.6c0,0,0,1.6-1.6,1.6s-1.6-1.6-1.6-1.6 V-12.9z"/></g><g id="g38" transform="translate(10,15)"><path id="path40" fill="#FFFFFF" d="M-2.1,3.2c0,0,2.4,0.8,7.1,0.8s7.1-0.8,7.1-0.8S10.5,6.3,5,6.3S-2.1,3.2-2.1,3.2"/></g></g></g></g></svg>'
		]);
	}
}