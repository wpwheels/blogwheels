/**
 * Creates the overline RichText format type.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import { overlineIcon } from "../../common/utils-icon";

// WordPress dependencies.
import { RichTextToolbarButton } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { toggleFormat } from "@wordpress/rich-text";

/**
 * Name of the format.
 * @type {string}
 */
const name = "blockwheels/overline";

/**
 * RichText format type definition.
 * @type {object}
 */
export default {
	name,
	title: __("Overline", "blogwheels"),
	tagName: "span",
	className: "has-overline",
	edit: ({ isActive, onChange, value }) => (
		<RichTextToolbarButton
			icon={overlineIcon}
			title={__("Overline", "blogwheels")}
			isActive={isActive}
			onClick={() => onChange(toggleFormat(value, { type: name }))}
		/>
	),
};
