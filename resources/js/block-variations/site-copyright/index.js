/**
 * Site Copyright variation.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

import { copyrightIcon } from "../../common/utils-icon";
import { __, sprintf } from "@wordpress/i18n";

export default {
	block: "core/paragraph",
	variation: {
		name: "blockwheels/site-copyright",
		title: __("Site Copyright", "blogwheels"),
		description: __("Displays the site copyright date.", "blogwheels"),
		category: "widgets",
		keywords: ["copyright"],
		icon: copyrightIcon,
		scope: ["inserter"],
		attributes: {
			metadata: {
				bindings: {
					content: {
						source: "blockwheels/site",
						args: {
							key: "copyright",
						},
					},
				},
			},
			content: sprintf(
				// Translators: %s is the copyright year.
				__("Copyright © %s", "blogwheels"),
				new Date().getFullYear(),
			),
		},
		isActive: [
			"metadata.bindings.content.source",
			"metadata.bindings.content.args.key",
		],
	},
};
