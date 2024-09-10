/**
 * Creates the insert RichText format type.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import { insertIcon } from "../../common/utils-icon";

// WordPress dependencies.
import { RichTextToolbarButton } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { toggleFormat } from "@wordpress/rich-text";

/**
 * Name of the format.
 * @type {string}
 */
const name = "blockwheels/ins";

/**
 * RichText format type definition.
 * @type {object}
 */
export default {
	name,
	title: __("Insert", "blogwheels"),
	tagName: "ins",
	className: null,
	edit: ({ isActive, onChange, value }) => (
		<RichTextToolbarButton
			icon={insertIcon}
			title={__("Insert", "blogwheels")}
			isActive={isActive}
			onClick={() => onChange(toggleFormat(value, { type: name }))}
		/>
	),
};
