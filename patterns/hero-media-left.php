<?php

/**
 * Title: Hero: Media Left
 * Slug: blogwheels/hero-media-left
 * Categories: featured, blockwheels-hero
 * Keywords: hero, intro, about
 * Block Types: core/columns
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

use BLOGWHEELS\Tools\Language;

$image = get_theme_file_uri('public/media/images/mountain-road.webp');

?>
<!-- wp:group {
	"tagName":"section",
	"metadata":{
		"name":"<?= esc_attr__('Hero: Media Right', 'blogwheels') ?>"
	},
	"align":"full",
	"style":{
		"spacing":{
			"padding":{
				"top":"var:preset|spacing|plus-5",
				"bottom":"var:preset|spacing|plus-5"
			}
		}
	},
	"className":"is-style-section-3",
	"layout":{"type":"constrained"}
} -->
<section class="wp-block-group alignfull is-style-section-3" style="padding-top:var(--wp--preset--spacing--plus-5);padding-bottom:var(--wp--preset--spacing--plus-5)">

	<!-- wp:columns {
		"verticalAlignment":"center",
		"align":"full",
		"style":{
			"spacing":{
				"blockGap":{
					"top":"0",
					"left":"var:preset|spacing|plus-3"
				}
			}
		},
		"className":"is-style-reverse-stack"
	} -->
	<div class="wp-block-columns alignfull are-vertically-aligned-center is-style-reverse-stack">

		<!-- wp:column {
			"verticalAlignment":"center",
			"width":"",
			"layout":{"type":"default"}
		} -->
		<div class="wp-block-column is-vertically-aligned-center">

			<!-- wp:image {
				"lightbox":{"enabled":false},
				"aspectRatio":"4/3",
				"scale":"cover",
				"sizeSlug":"full",
				"style":{
					"layout":{
						"selfStretch":"fill",
						"flexSize":null
					}
				}
			} -->
			<figure class="wp-block-image size-full">
				<img src="<?= esc_url($image) ?>" alt="" style="aspect-ratio:4/3;object-fit:cover"/>
			</figure>
			<!-- /wp:image -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {
			"verticalAlignment":"center",
			"width":"",
			"style":{
				"spacing":{
					"padding":{
						"top":"var:preset|spacing|plus-3",
						"bottom":"var:preset|spacing|plus-3",
						"left":"var:preset|spacing|plus-3",
						"right":"var:preset|spacing|plus-3"
					}
				}
			},
			"layout":{
				"type":"constrained",
				"justifyContent":"left"
			}
		} -->
		<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--plus-3);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-3);padding-left:var(--wp--preset--spacing--plus-3)">

			<!-- wp:heading {"fontSize":"6-xl"} -->
			<h2 class="wp-block-heading has-6-xl-font-size"><?= esc_html__('Jump start your next project with our open-source engine', 'blogwheels') ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?= esc_html(Language::loremIpsum(20)) ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">

				<!-- wp:button {"className":"is-style-fill"} -->
				<div class="wp-block-button is-style-fill">
					<a class="wp-block-button__link wp-element-button"><?= esc_html__('Download', 'blogwheels') ?></a>
				</div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline">
					<a class="wp-block-button__link wp-element-button"><?= esc_html__('Learn More &rarr;', 'blogwheels') ?></a>
				</div>
				<!-- /wp:button -->

			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</section>
<!-- /wp:group -->