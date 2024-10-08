/**
 * Comment parent link variation.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

import { comment } from "@wordpress/icons";
import { __ } from "@wordpress/i18n";

export default {
	block: "core/paragraph",
	variation: {
		name: "blockwheels/comment-parent-link",
		title: __("Comment Parent Link", "blogwheels"),
		description: __("Displays a link to the comment parent.", "blogwheels"),
		category: "widgets",
		keywords: ["comment", "parent"],
		icon: comment,
		scope: [], // For internal use, so leave scope empty.
		ancestor: "core/comment-template",
		attributes: {
			metadata: {
				bindings: {
					content: {
						source: "blockwheels/comment",
						args: {
							key: "parentLink",
						},
					},
				},
			},
			placeholder: __("In reply to Comment Author", "blogwheels"),
		},
		isActive: [
			"metadata.bindings.content.source",
			"metadata.bindings.content.args.key",
		],
	},
};
