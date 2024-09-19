<?php

/**
 * Title: Section: Vertical Social Profile Cards
 * Slug: blogwheels/section-cards-profile-stack-social
 * Categories: team, blogwheels-grid
 * Keywords: card, grid, profile, social, team
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"section",
	"metadata":{"name":"<?= esc_attr__('Section', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"padding":{
				"right":"var:preset|spacing|plus-3",
				"left":"var:preset|spacing|plus-3",
				"top":"var:preset|spacing|plus-4",
				"bottom":"var:preset|spacing|plus-4"
			}
		}
	},
	"align":"full",
	"className":"is-style-section-1",
	"layout":{"type":"constrained"}
} -->
<section class="wp-block-group alignfull is-style-section-1" style="padding-top:var(--wp--preset--spacing--plus-4);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-4);padding-left:var(--wp--preset--spacing--plus-3)">

	<!-- wp:pattern {"slug":"blogwheels/section-header"} /-->

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Grid', 'blogwheels') ?>"},
		"align":"wide",
		"layout":{"type":"grid","minimumColumnWidth":"16rem"}
	} -->
	<div class="wp-block-group alignwide">

		<?php foreach (range(1, 6) as $card) : ?>
			<!-- wp:pattern {"slug":"blogwheels/card-profile-stack-social"} /-->
		<?php endforeach ?>

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->
