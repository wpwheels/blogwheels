<?php

/**
 * Title: Gallery: Seamless
 * Slug: blogwheels/gallery-seamless
 * Description:
 * Categories: gallery
 * Keywords: gallery, images
 * Block Types: core/gallery
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/mountain-road.webp');

?>
<!-- wp:gallery {
	"linkTo":"none",
	"sizeSlug":"blockwheels-portrait",
	"align":"wide",
	"style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}
} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-default is-cropped">

	<?php foreach (range(1, 3) as $number) : ?>

		<!-- wp:image {
			"sizeSlug":"blockwheels-portrait",
			"linkDestination":"none",
			"style":{"border":{"radius":"0px"}}
		} -->
		<figure class="wp-block-image size-blockwheels-portrait has-custom-border">
			<img src="<?= esc_url($image) ?>" alt="" style="border-radius:0px"/>
		</figure>
		<!-- /wp:image -->

	<?php endforeach ?>

</figure>
<!-- /wp:gallery -->