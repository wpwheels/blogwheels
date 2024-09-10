<?php

/**
 * Title: Home Template
 * Slug: blogwheels/template-home
 * Inserter: no
 * Template Types: home, front-page
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
	"className":"site-content",
	"layout":{"type":"constrained"}
} -->
<main class="wp-block-group site-content">
	<!-- wp:pattern {
		"metadata":{"@unless":"is_paged"},
		"slug":"blogwheels/hero-featured"
	} /-->
	<!-- wp:template-part {"slug":"loop","align":"full","className":"loop"} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
