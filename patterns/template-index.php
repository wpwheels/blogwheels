<?php

/**
 * Title: Index Template
 * Slug: blogwheels/template-index
 * Inserter: no
 * Template Types: archive, author, category, date, home, front-page, tag, taxonomy
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:template-part {"slug":"header","className":"site-header"} /-->

<!-- wp:group {
	"tagName":"main",
	"metadata":{"name":"<?= esc_attr__('Content', 'blogwheels') ?>"},
	"layout":{"type":"constrained"}
} -->
<main class="wp-block-group">
	<!-- wp:template-part {"slug":"loop","align":"full","className":"loop"} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
