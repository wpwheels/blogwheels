<?php

/**
 * Title: Footer: Call to Action
 * Slug: blogwheels/footer-call-to-action
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
	"align":"full",
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|plus-5",
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
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--plus-6);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-6);padding-left:var(--wp--preset--spacing--plus-3)">

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Call To Action', 'blogwheels') ?>"},
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|base"
			}
		},
		"layout":{"type":"constrained"}
	} -->
	<div class="wp-block-group">

		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="wp-block-heading has-text-align-center"><?= esc_html__('Ready to change your life?', 'blogwheels') ?><br><?= esc_html__('Start today.', 'blogwheels') ?></h2>
		<!-- /wp:heading -->

		<!-- wp:buttons {
			"layout":{
				"type":"flex",
				"justifyContent":"center"
			}
		} -->
		<div class="wp-block-buttons">

			<!-- wp:button -->
			<div class="wp-block-button">
				<a class="wp-block-button__link wp-element-button"><?= esc_html__('Get Started →', 'blogwheels') ?></a>
			</div>
			<!-- /wp:button -->

		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Divider', 'blogwheels') ?>"},
		"layout":{"type":"constrained"}
	} -->
	<div class="wp-block-group">
		<!-- wp:separator {"className":"is-style-hand-drawn"} -->
		<hr class="wp-block-separator has-alpha-channel-opacity is-style-hand-drawn"/>
		<!-- /wp:separator -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Footer Content', 'blogwheels') ?>"},
		"align":"full",
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|base"
			}
		},
		"layout":{"type":"default"}
	} -->
	<div class="wp-block-group alignfull">

		<!-- wp:pattern {"slug":"blogwheels/social-menu-buttons-primary"} /-->

		<!-- wp:site-title {
			"textAlign":"center",
			"isLink":false,
			"className":"is-style-normalize"
		} /-->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
