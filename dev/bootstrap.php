<?php

/**
 * Bootstraps dev features.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Ideas\Dev;

# Prevent direct execution.
if (! defined('ABSPATH')) {
	return;
}

# Bootstrap dev.
add_action('after_setup_theme', __NAMESPACE__ . '\\bootstrap', PHP_INT_MIN);
