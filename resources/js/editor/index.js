/**
 * Block editor filters.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

import { addFilter } from "@wordpress/hooks";

/**
 * Returns the theme's default featured image size so that it's rendered in the
 * featured image component in the sidebar panel.
 *
 * @returns {string}
 */
const withImageSize = () => "blockwheels-wide";

addFilter(
	"editor.PostFeaturedImage.imageSize",
	"blockwheels/ideas/featured-image-size",
	withImageSize,
);
