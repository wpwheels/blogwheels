<?php

/**
 * Title: Footer: Default
 * Slug: blogwheels/footer-default
 * Description:
 * Categories: footer
 * Keywords: footer
 * Block Types: core/template-part/footer
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Footer Container', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"padding":{
				"top":"var:preset|spacing|plus-6",
				"bottom":"var:preset|spacing|plus-6",
				"left":"var:preset|spacing|plus-3",
				"right":"var:preset|spacing|plus-3"
			}
		}
	},
	"layout":{"type":"default"}
} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--plus-6);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-6);padding-left:var(--wp--preset--spacing--plus-3)">

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Footer Content', 'blogwheels') ?>"},
		"align":"wide",
		"style":{
			"spacing":{
				"blockGap":"0"
			}
		},
		"layout":{
			"type":"flex",
			"orientation":"vertical",
			"justifyContent":"center"
		}
	} -->
	<div class="wp-block-group alignwide">
		<!-- wp:site-title {
			"level":0,
			"isLink":false,
			"className":"is-style-normalize"
		} /-->

		<!-- wp:paragraph {
			"metadata":{
				"bindings":{
					"content":{
						"source":"blogwheels/theme",
						"args":{
							"key":"superpower"
						}
					}
				}
			},
			"placeholder":"<?= esc_attr__('Powered by WordPress, crazy ideas, and passion.', 'blogwheels') ?>"
		} -->
		<p></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:pattern {"slug":"blogwheels/social-menu-buttons-primary"} /-->

</div>
<!-- /wp:group -->
