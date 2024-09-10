<?php

/**
 * Title: Post: Box
 * Slug: blogwheels/post-box
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"article",
	"metadata":{
		"name":"<?= esc_attr__('Post', 'blogwheels') ?>"
	},
	"style":{
		"dimensions":{
			"minHeight":"100%"
		}
	},
	"className":"has-global-border is-style-section-3",
	"layout":{
		"type":"flex",
		"orientation":"vertical",
		"verticalAlignment":"space-between",
		"justifyContent":"stretch"
	}
} -->
<article class="wp-block-group has-global-border is-style-section-3" style="min-height:100%">

	<!-- wp:group {
		"metadata":{
			"name":"<?= esc_attr__('Post Container', 'blogwheels') ?>"
		},
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|base"
			}
		},
		"layout":{
			"type":"default"
		}
	} -->
	<div class="wp-block-group">

		<!-- wp:post-featured-image {
			"isLink":true,
			"aspectRatio":"16/9",
			"className":"is-style-borderless"
		} /-->

		<!-- wp:group {
			"tagName":"header",
			"metadata":{
				"name":"<?= esc_attr__('Post Header', 'blogwheels') ?>"
			},
			"layout":{"type":"default"}
		} -->
		<header class="wp-block-group">
			<!-- wp:post-title {"isLink":true} /-->
		</header>
		<!-- /wp:group -->

		<!-- wp:post-excerpt {
			"moreText":"<?= esc_html__('Continue reading &rarr;', 'blogwheels') ?>",
			"showMoreOnNewLine":false,
			"excerptLength":20
		} /-->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {
		"tagName":"footer",
		"metadata":{
			"name":"<?= esc_attr__('Post Footer', 'blogwheels') ?>"
		},
		"layout":{"type":"default"}
	} -->
	<footer class="wp-block-group">
		<!-- wp:pattern {"slug":"blogwheels/post-byline-short"} /-->
	</footer>
	<!-- /wp:group -->

</article>
<!-- /wp:group -->
