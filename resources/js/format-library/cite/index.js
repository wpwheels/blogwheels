/**
 * Creates the mark RichText format type.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import { citeIcon } from "../../common/utils-icon";

// WordPress dependencies.
import { RichTextToolbarButton } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { toggleFormat } from "@wordpress/rich-text";

/**
 * Name of the format.
 * @type {string}
 */
const name = "blockwheels/cite";

/**
 * RichText format type definition.
 * @type {object}
 */
export default {
	name,
	title: __("Cite", "blogwheels"),
	tagName: "cite",
	className: null,
	edit: ({ isActive, onChange, value }) => (
		<RichTextToolbarButton
			icon={citeIcon}
			title={__("Cite", "blogwheels")}
			isActive={isActive}
			onClick={() => onChange(toggleFormat(value, { type: name }))}
		/>
	),
};
