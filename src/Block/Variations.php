<?php

/**
 * The Variations class is used for registering block variations via PHP.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Ideas\Block;

use WP_Block_Type;
use BLOGWHEELS\Ideas\Contracts\Bootable;
use BLOGWHEELS\Ideas\Tools\Hooks\{Filter, Hookable};

class Variations implements Bootable
{
	use Hookable;

	/**
	 * Boots the component, running its actions/filters.
	 *
	 * @since 1.0.0
	 */
	#[\Override]
	public function boot(): void
	{
		$this->hookMethods();
	}

	/**
	 * Register custom block variations.
	 *
	 * @since 1.0.0
	 */
	#[Filter('get_block_type_variations')]
	public function register(array $variations, WP_Block_Type $block): array
	{
		if ('core/spacer' === $block->name) {
			$variations[] = $this->spacer();
		}

		return $variations;
	}

	/**
	 * Registers the theme spacer as the default so that (with any luck)
	 * users will choose the theme spacing sizes over custom sizes. Note
	 * that there is currently no way to set the default spacer size via
	 * `theme.json` nor is there a way to disable custom spacing sizes.
	 *
	 * @since 1.0.0
	 */
	private function spacer(): array
	{
		return [
			'name'       => 'blockwheels/theme-spacer',
			'title'      => __('Spacer', 'blogwheels'),
			'isDefault'  => true,
			'keywords'   => [ 'space', 'spacer', 'spacing' ],
			'isActive'   => [ 'height' ],
			'attributes' => [
				'height' => 'var:preset|spacing|plus-8'
			]
		];
	}
}
