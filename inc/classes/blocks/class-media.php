<?php
/**
 * Media binding class.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc\Blocks;

use WP_Block;
use WP_Block_Bindings_Registry;
use BLOGWHEELS\Inc\Helpers\Media_Meta;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Media.
 */
class Media
{
	use Singleton;

	/**
	 * Map of keys to their associated methods.
	 *
	 * @since 1.0.0
	 * @todo  Type hint with PHP 8.3+ requirement.
	 */
	private const KEY_METHODS = [
		'alt'     => 'renderAlt',
		'caption' => 'renderCaption',
		'src'     => 'renderUrl', // alias for `url`
		'url'     => 'renderUrl'
	];

	/**
	 * Stores the post ID.
	 *
	 * @since 1.0.0
	 */
	private int $post_id = 0;

	/**
	 * Stores instances of the `Media_Meta` class by post ID.
	 *
	 * @var   Media_Meta[]
	 * @since 1.0.0
	 */
	private array $meta = [];

	/**
	 * Registers the block binding source.
	 *
	 * @since 1.0.0
	 */
	public function register(WP_Block_Bindings_Registry $bindings): void
	{
		$bindings->register('blockwheels/media', [
			'label'              => __('Media Data', 'blogwheels'),
			'uses_context'       => ['postType', 'postId'],
			'get_value_callback' => [$this, 'callback']
		]);
	}

	/**
	 * Returns media data based on the bound attribute.
	 *
	 * @since 1.0.0
	 */
	public function callback(array $args, WP_Block $block, string $name): ?string
	{
		$this->post_id = $block->context['postId'] ?? get_the_ID();

		// If no key is explicitly passed in, use the attribute name.
		$args['key'] ??= $name;

		if (isset(self::KEY_METHODS[$args['key']])) {
			$method = self::KEY_METHODS[$args['key']];

			return $this->$method($args);
		}

		return $this->renderMeta($args);
	}

	/**
	 * Returns an attachment source URL.
	 *
	 * @since 1.0.0
	 */
	private function renderUrl(array $args): ?string
	{
		if (isset($args['type']) && 'image' === $args['type']) {
			$image = wp_get_attachment_image_src(
				$this->post_id,
				$args['size'] ?? 'full'
			);

			return is_array($image) ? esc_url($image[0]) : null;
		}

		$url = wp_get_attachment_url($this->post_id);

		return $url ? esc_url($url) : null;
	}

	/**
	 * Returns an image attachment alt text.
	 *
	 * @since 1.0.0
	 */
	private function renderAlt(): ?string
	{
		$alt = get_post_meta($this->post_id, '_wp_attachment_image_alt', true);

		return $alt ? esc_attr($alt) : null;
	}

	/**
	 * Returns an image attachment caption.
	 *
	 * @since 1.0.0
	 */
	private function renderCaption(): ?string
	{
		$caption = wp_get_attachment_caption($this->post_id);

		return $caption ? esc_html($caption) : null;
	}

	/**
	 * Returns an attachment's media metadata based on key.
	 *
	 * @since 1.0.0
	 */
	private function renderMeta(array $args): ?string
	{
		$this->meta[$this->post_id] ??= new Media_Meta(get_post($this->post_id));

		$data = $this->meta[$this->post_id]->render($args['key']);

		// If there's a label, let's wrap it and the metadata in some markup.
		if ($data && isset($args['label'])) {
			$data = sprintf(
				'<span class="media-data__label" style="font-weight:500">%s</span>
				<span class="media-data__content has-xs-font-size has-mono-font-family">%s</span>',
				esc_html($args['label']),
				$data
			);
		}

		return $data ?: null;
	}
}