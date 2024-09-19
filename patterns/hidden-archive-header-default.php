<?php

/**
 * Title: Archive Header: Default
 * Slug: blogwheels/archive-header-default
 * Inserter: no
 * Categories: blogwheels-layout
 * Viewport Width: 1376
 * Block Types: core/template-part/archive-header
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Archive Header Content', 'blogwheels') ?>"},
	"align":"full",
	"className":"is-style-section-2",
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|base",
			"padding":{
				"top":"var:preset|spacing|plus-6",
				"bottom":"var:preset|spacing|plus-6"
			}
		}
	},
	"layout":{
		"type":"constrained",
		"justifyContent":"left"
	}
} -->
<div class="wp-block-group alignfull is-style-section-2" style="padding-top:var(--wp--preset--spacing--plus-6);padding-bottom:var(--wp--preset--spacing--plus-6)">

	<!-- wp:query-title {
		"type":"archive",
		"showPrefix":false,
		"align":"wide"
	} /-->

	<!-- wp:term-description /-->

</div>
<!-- /wp:group -->
