<?php

/**
 * Editor settings for dev mode.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Dev;

use BLOGWHEELS\Contracts\Bootable;
use BLOGWHEELS\Tools\Hooks\{Filter, Hookable};

class Editor implements Bootable
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
	 * Enables features that are disabled for production installs.
	 *
	 * @since 1.0.0
	 */
	#[Filter('block_editor_settings_all', 'last')]
	public function registerSettings(array $settings): array
	{
		$settings['fontLibraryEnabled'] = true;

		return $settings;
	}
}
