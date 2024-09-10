<?php

/**
 * Title: Section: Vertical Character Cards
 * Slug: blogwheels/section-cards-character-stack
 * Categories: team, blockwheels-grid
 * Keywords: card, grid, profile, team
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"section",
	"metadata":{"name":"<?= esc_attr__('Section', 'blogwheels') ?>"},
	"align":"full",
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
	"className":"is-style-section-3",
	"layout":{
		"type":"constrained",
		"contentSize":"40rem",
		"wideSize":"80rem"
	}
} -->
<section class="wp-block-group alignfull is-style-section-3" style="padding-top:var(--wp--preset--spacing--plus-4);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-4);padding-left:var(--wp--preset--spacing--plus-3)">

	<!-- wp:pattern {"slug":"blogwheels/section-header"} /-->

	<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Grid', 'blogwheels') ?>"},
		"align":"wide",
		"layout":{"type":"grid","minimumColumnWidth":"19rem"}
	} -->
	<div class="wp-block-group alignwide">

		<?php foreach (range(1, 6) as $card) : ?>
			<!-- wp:pattern {"slug":"blogwheels/card-character-stack"} /-->
		<?php endforeach ?>

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->
