<?php

/**
 * Title: Author Template
 * Slug: blogwheels/template-author
 * Inserter: no
 * Template Types: author
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
		"metadata":{"name":"<?= esc_attr__('Archive Header', 'blogwheels') ?>"},
		"align":"full",
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|base"
			}
		},
		"layout":{"type":"constrained"},
		"className":"is-style-archive-header"
	} -->
	<div class="wp-block-group alignfull is-style-archive-header">

		<!-- wp:group {
			"style":{"spacing":{"blockGap":"var:preset|spacing|base"}},
			"layout":{"type":"flex","flexWrap":"nowrap"}
		} -->
		<div class="wp-block-group">
			<!-- wp:avatar {"size":64} /-->
			<!-- wp:query-title {"type":"archive","showPrefix":false} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-author-biography /-->

	</div>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"loop","align":"full","className":"loop"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
