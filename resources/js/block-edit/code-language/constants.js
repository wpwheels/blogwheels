/**
 * Houses constants needed for the component.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

// WordPress dependencies.
import { __ } from "@wordpress/i18n";

/**
 * Array of supported blocks for the filter.
 * @type {array}
 */
export const SUPPORTED_BLOCKS = ["core/code"];

/**
 * Prefix used for the class name.
 * @type {string}
 */
export const LANGUAGE_PREFIX = "language-";

/**
 * Array of icon options. Ideally, we'd be able to pull these from
 * `theme.json`, but the `settings.custom` options is best suited to CSS custom
 * properties and not text strings (for the labels).
 * @type {array}
 */
export const LANGUAGES = [
	{ value: "css", label: __("CSS", "blogwheels") },
	{ value: "html", label: __("HTML", "blogwheels") },
	{ value: "js", label: __("JavaScript", "blogwheels") },
	{ value: "php", label: __("PHP", "blogwheels") },
	{ value: "scss", label: __("SCSS", "blogwheels") },
];
