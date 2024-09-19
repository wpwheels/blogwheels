<?php

/**
 * Title: Small Horizontal Profile Card
 * Slug: blogwheels/card-profile-row-small
 * Categories: team, blogwheels-card
 * Keywords: card, grid, profile, team
 * Viewport Width: 480
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Card', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"padding":{
				"top":"var:preset|spacing|base",
				"bottom":"var:preset|spacing|base",
				"left":"var:preset|spacing|base",
				"right":"var:preset|spacing|base"
			},
			"blockGap":"var:preset|spacing|base"
		}
	},
	"className":"has-global-border is-style-section-1",
	"layout":{
		"type":"flex",
		"flexWrap":"nowrap"
	},
	"fontSize":"sm"
} -->
<div class="wp-block-group has-global-border is-style-section-1 has-sm-font-size" style="padding-top:var(--wp--preset--spacing--base);padding-right:var(--wp--preset--spacing--base);padding-bottom:var(--wp--preset--spacing--base);padding-left:var(--wp--preset--spacing--base)">

	<!-- wp:avatar {
		"userId":1,
		"size":80,
		"isLink":true,
		"className":""
	} /-->

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Content', 'blogwheels') ?>"},
		"style":{"spacing":{"blockGap":"0"}},
		"layout":{"type":"default"}
	} -->
	<div class="wp-block-group">

		<!-- wp:heading {
			"level":3,
			"fontSize":"lg"
		} -->
		<h3 class="wp-block-heading has-lg-font-size"><?= esc_html__('User Name', 'blogwheels') ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?= esc_html__('User Role', 'blogwheels') ?></p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
