<?php

/**
 * Title: Table of Contents Card
 * Slug: blogwheels/card-table-of-contents
 * Description: Displays a post's table of contents within a Group block with a Heading.
 * Categories: text, blogwheels-card
 * Keywords: table, contents, list
 * Block Types: core/table-of-contents
 * Viewport Width: 640
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Table of Contents Card', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|base"
		}
	},
	"className":"has-global-border is-style-section-1",
	"layout":{"type":"default"}
} -->
<div class="wp-block-group has-global-border is-style-section-1">

	<!-- wp:paragraph {"fontFamily":"primary"} -->
	<p class="has-primary-font-family"><strong><?= esc_html__('Table of Contents', 'blogwheels') ?></strong></p>
	<!-- /wp:paragraph -->

	<!-- wp:table-of-contents {"className":"is-style-pull"} /-->

</div>
<!-- /wp:group -->
