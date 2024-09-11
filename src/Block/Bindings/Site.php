<?php

/**
 * Site binding class.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Block\Bindings;

use WP_Block;
use WP_Block_Bindings_Registry;
use BLOGWHEELS\Contracts\BlockBindingSource;

class Site implements BlockBindingSource
{
	/**
	 * Map of keys to their associated methods.
	 *
	 * @since 1.0.0
	 * @todo  Type hint with PHP 8.3+ requirement.
	 */
	private const KEY_METHODS = [
		'copyright' => 'renderCopyright',
		'year'      => 'renderYear'
	];

	/**
	 * Registers the block binding source.
	 *
	 * @since 1.0.0
	 */
	public function register(WP_Block_Bindings_Registry $bindings): void
	{
		$bindings->register('blockwheels/site', [
			'label'              => __('Site Data', 'blogwheels'),
			'get_value_callback' => [ $this, 'callback' ]
		]);
	}

	/**
	 * Returns site data based on the bound attribute.
	 *
	 * @since 1.0.0
	 */
	public function callback(array $args, WP_Block $block, string $name): ?string
	{
		if (isset($args['key']) && isset(self::KEY_METHODS[ $args['key'] ])) {
			$method = self::KEY_METHODS[ $args['key'] ];

			return $this->$method($args);
		}

		return null;
	}

	/**
	 * Returns the site copyright statement.
	 *
	 * @since 1.0.0
	 */
	private function renderCopyright(): string
	{
		return esc_html(sprintf(
			// Translators: %s is the current year.
			__('Copyright &copy; %s', 'blogwheels'),
			$this->renderYear()
		));
	}

	/**
	 * Returns the current year.
	 *
	 * @since 1.0.0
	 */
	private function renderYear(): string
	{
		return esc_html(wp_date('Y'));
	}
}
