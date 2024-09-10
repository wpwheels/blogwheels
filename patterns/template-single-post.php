<?php

/**
 * Title: Single Post Template
 * Slug: blogwheels/template-single-post
 * Inserter: no
 * Template Types: attachment, page, single, singular
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:template-part {"slug":"header","className":"site-header"} /-->

<!-- wp:group {
	"tagName":"main",
	"metadata":{"name":"<?= esc_attr__('Content', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"blockGap":"0"
		}
	},
	"layout":{"type":"default"}
} -->
<main class="wp-block-group">

	<!-- wp:group {
		"tagName":"article",
		"metadata":{"name":"<?= esc_attr__('Post', 'blogwheels') ?>"},
		"style":{
			"spacing":{
				"padding":{
					"top":"var:preset|spacing|plus-3",
					"bottom":"var:preset|spacing|plus-3"
				}
			}
		},
		"layout":{"type":"default"}
	} -->
	<article class="wp-block-group" style="padding-top:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-3)">

		<!-- wp:group {
			"tagName":"header",
			"metadata":{"name":"<?= esc_attr__('Post Header', 'blogwheels') ?>"},
			"style":{
				"spacing":{
					"blockGap":"var:preset|spacing|base"
				}
			},
			"layout":{"type":"constrained"}
		} -->
		<header class="wp-block-group">
			<!-- wp:post-title {"level":1} /-->
			<!-- wp:pattern {"slug":"blogwheels/post-byline"} /-->
		</header>
		<!-- /wp:group -->

		<!-- wp:post-content {
			"layout":{"type":"constrained"},
			"className":"is-style-prose"
		} /-->

		<!-- wp:pattern {"slug":"blogwheels/post-meta"} /-->

	</article>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"comments"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
