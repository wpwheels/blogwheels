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
	"className":"is-style-site-footer",
	"layout":{"type":"default"}
} -->
<div class="wp-block-group is-style-site-footer">

	<!-- wp:pattern {"slug":"blogwheels/social-menu-outline"} /-->

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
						"source":"blockwheels/theme",
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

</div>
<!-- /wp:group -->
