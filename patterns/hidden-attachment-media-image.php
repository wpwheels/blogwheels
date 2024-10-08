<?php

/**
 * Title: Attachment Media: Image
 * Slug: blogwheels/attachment-media-image
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">

	<!-- wp:image {
		"align":"wide",
		"sizeSlug":"blockwheels-wide",
		"linkDestination":"none",
		"metadata":{
			"bindings":{
				"url":{
					"source":"blockwheels/media",
					"args":{
						"type":"image",
						"size":"blockwheels-wide"
					}
				},
				"alt":{
					"source":"blockwheels/media"
				}
			},
			"@ifAttribute":"url"
		}
	} -->
	<figure class="wp-block-image alignwide size-blockwheels-wide">
		<img src="" alt="" />
	</figure>
	<!-- /wp:image -->

</div>
<!-- /wp:group -->
