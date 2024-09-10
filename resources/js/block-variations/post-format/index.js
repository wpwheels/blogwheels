/**
 * Post format variation for the Post Terms block.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

import { __ } from "@wordpress/i18n";
import { pencil } from "@wordpress/icons";

export default {
	block: "core/post-terms",
	variation: {
		name: "blockwheels/post-format",
		title: __("Format", "blogwheels"),
		icon: pencil,
		description: __("Displays the assigned post format.", "blogwheels"),
		scope: ["block", "inserter", "transform"],
		attributes: {
			term: "post_format",
		},
		isActive: ["term"],
	},
};
