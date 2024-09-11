<?php

/**
 * Theme functions file, which is auto-loaded by WordPress. This file is used to
 * load any other necessary PHP files and bootstrap the theme.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS;

# Prevent direct access.
defined('ABSPATH') || exit;

# Load the autoloader.
if (! class_exists(Theme::class) && is_file(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

# Bootstrap the theme.
add_action('after_setup_theme', __NAMESPACE__ . '\\boot', PHP_INT_MIN);