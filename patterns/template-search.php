<?php

/**
 * Title: Search Template
 * Slug: blogwheels/template-search
 * Inserter: no
 * Template Types: search
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:template-part {"slug":"header","className":"site-header"} /-->

<!-- wp:group {
	"tagName":"main",
	"metadata":{"name":"<?= esc_attr__('Content', 'blogwheels') ?>"},
	"style":{"spacing":{"blockGap":"0"}},
	"layout":{"type":"constrained"}
} -->
<main class="wp-block-group">

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Search Header', 'blogwheels') ?>"},
		"align":"full",
		"style":{
			"spacing":{
				"padding":{
					"top":"var:preset|spacing|plus-3",
					"right":"var:preset|spacing|plus-3",
					"bottom":"var:preset|spacing|plus-3",
					"left":"var:preset|spacing|plus-3"
				},
				"blockGap":"var:preset|spacing|base"
			}
		},
		"layout":{"type":"constrained"},
		"className":"is-style-archive-header"
	} -->
	<div class="wp-block-group alignfull is-style-archive-header">
		<!-- wp:query-title {"type":"search"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"loop","align":"full","className":"loop"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
