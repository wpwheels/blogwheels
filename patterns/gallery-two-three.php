<?php

/**
 * Title: Gallery: Two-Three
 * Slug: blogwheels/gallery-two-three
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
	"columns":3,
	"linkTo":"none",
	"sizeSlug":"blockwheels-wide",
	"align":"wide",
	"className":"is-style-reverse"
} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped is-style-reverse">

	<?php foreach (range(1, 5) as $number) : ?>

		<!-- wp:image {
			"sizeSlug":"blockwheels-wide",
			"linkDestination":"none"
		} -->
		<figure class="wp-block-image size-blockwheels-wide">
			<img src="<?= esc_url($image) ?>" alt=""/>
		</figure>
		<!-- /wp:image -->

	<?php endforeach ?>

</figure>
<!-- /wp:gallery -->
