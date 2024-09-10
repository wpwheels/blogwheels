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
export const SUPPORTED_BLOCKS = [
	"core/archives",
	"core/categories",
	"core/list",
	"core/page-list",
];

/**
 * Prefix used for the class name.
 * @type {string}
 */
export const MARKER_PREFIX = "has-marker-";

/**
 * Unordered list options.
 * @type {array}
 */
export const UL_MARKERS = [
	{ value: "disc", label: __("Disc", "blogwheels") },
	{ value: "circle", label: __("Circle", "blogwheels") },
	{ value: "square", label: __("Square", "blogwheels") },
	{ value: "none", label: __("None", "blogwheels") },
];

/**
 * Ordered list options.
 * @type {array}
 */
export const OL_MARKERS = [
	{ value: "decimal", label: __("Decimal", "blogwheels") },
	{ value: "leading-zero", label: __("Leading Zero", "blogwheels") },
	{ value: "upper-alpha", label: __("Alphabetical: Uppercase", "blogwheels") },
	{ value: "lower-alpha", label: __("Alphabetical: Lowercase", "blogwheels") },
	{ value: "upper-roman", label: __("Roman: Uppercase", "blogwheels") },
	{ value: "lower-roman", label: __("Roman: Lowercase", "blogwheels") },
	{ value: "none", label: __("None", "blogwheels") },
];

/**
 * Combined array of list options.
 * @type {array}
 */
export const MARKERS = [...UL_MARKERS, ...OL_MARKERS];
