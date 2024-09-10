<?php

/**
 * Title: Archive Template
 * Slug: blogwheels/template-archive
 * Inserter: no
 * Template Types: archive, author, category, date, tag, taxonomy
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
		<!-- wp:query-title {"type":"archive","showPrefix":false} /-->
		<!-- wp:term-description /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"loop","align":"full","className":"loop"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
