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

$theme_version = wp_get_theme()->get( 'Version' );

if ( ! defined( 'BLOGWHEELS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'BLOGWHEELS_VERSION', $theme_version );
}

if ( ! defined( 'BLOGWHEELS_DIR_PATH' ) ) {
	define( 'BLOGWHEELS_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'BLOGWHEELS_DIR_URI' ) ) {
	define( 'BLOGWHEELS_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'BLOGWHEELS_BUILD_URI' ) ) {
	define( 'BLOGWHEELS_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/build' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_PATH' ) ) {
	define( 'BLOGWHEELS_BUILD_PATH', untrailingslashit( get_template_directory() ) . '/build' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_JS_URI' ) ) {
	define( 'BLOGWHEELS_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/build/js' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_JS_DIR_PATH' ) ) {
	define( 'BLOGWHEELS_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/build/js' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_IMG_URI' ) ) {
	define( 'BLOGWHEELS_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/build/src/img' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_CSS_URI' ) ) {
	define( 'BLOGWHEELS_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/build/css' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_CSS_DIR_PATH' ) ) {
	define( 'BLOGWHEELS_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/build/css' );
}

if ( ! defined( 'BLOGWHEELS_BUILD_LIB_URI' ) ) {
	define( 'BLOGWHEELS_BUILD_LIB_URI', untrailingslashit( get_template_directory_uri() ) . '/build/library' );
}

if ( ! defined( 'BLOGWHEELS_ARCHIVE_POST_PER_PAGE' ) ) {
	define( 'BLOGWHEELS_ARCHIVE_POST_PER_PAGE', 9 );
}

if ( ! defined( 'BLOGWHEELS_SEARCH_RESULTS_POST_PER_PAGE' ) ) {
	define( 'BLOGWHEELS_SEARCH_RESULTS_POST_PER_PAGE', 9 );
}

require_once BLOGWHEELS_DIR_PATH . '/inc/autoloader.php';

function blogwheels_get_theme_instance() {
	new \BLOGWHEELS\Inc\Theme();
}
blogwheels_get_theme_instance();