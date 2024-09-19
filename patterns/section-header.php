<?php

/**
 * Title: Section Header
 * Slug: blogwheels/section-header
 * Categories: blogwheels-layout
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

use BLOGWHEELS\Inc\Helpers\Language;

?>
<!-- wp:group {
	"allowedBlocks":[
		"core/heading",
		"core/paragraph",
		"core/buttons"
	],
	"lock":{
		"move":true,
		"remove":true
	},
	"tagName":"header",
	"metadata":{"name":"<?= esc_attr__('Section Header', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|base"
		}
	},
	"typography":{"textAlign":"center"},
	"layout":{"type":"constrained"}
} -->
<header class="wp-block-group has-text-align-center">

	<!-- wp:heading {
		"lock":{
			"move":false,
			"remove":true
		}
	} -->
	<h2 class="wp-block-heading"><?= esc_html__('Placeholder Heading', 'blogwheels') ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p><?= esc_html(Language::loremIpsum()) ?></p>
	<!-- /wp:paragraph -->

</header>
<!-- /wp:group -->
