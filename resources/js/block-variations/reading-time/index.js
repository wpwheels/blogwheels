/**
 * Reading Time variation.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

import { timerIcon } from "../../common/utils-icon";
import { __, sprintf } from "@wordpress/i18n";

export default {
	block: "core/paragraph",
	variation: {
		name: "blockwheels/post",
		title: __("Reading Time", "blogwheels"),
		description: __(
			"Displays the estimated time to read the post.",
			"blogwheels",
		),
		category: "theme",
		keywords: ["time", "read", "reading"],
		icon: timerIcon,
		scope: ["inserter"],
		attributes: {
			metadata: {
				bindings: {
					content: {
						source: "blockwheels/post",
						args: {
							key: "readingTime",
						},
					},
				},
			},
			placeholder: __("Reading Time", "blogwheels"),
		},
		example: {},
		isActive: [
			"metadata.bindings.content.source",
			"metadata.bindings.content.args.key",
		],
	},
};
