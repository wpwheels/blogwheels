<?php

/**
 * Title: Query Pagination: Default
 * Slug: blogwheels/query-pagination-default
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:query-pagination {
	"paginationArrow":"arrow",
	"layout":{
		"type":"flex",
		"justifyContent":"right"
	}
} -->
	<!-- wp:paragraph {
		"metadata":{
			"bindings":{
				"content":{
					"source":"blogwheels/theme",
					"args":{
						"key":"paginationLabel"
					}
				}
			},
			"@ifAttribute":"content"
		},
		"placeholder":"<?= esc_attr__('Page 3 / 7:', 'blogwheels') ?>",
		"className":"pagination-label"
	} -->
	<p class="pagination-label"></p>
	<!-- /wp:paragraph -->
	<!-- wp:query-pagination-previous /-->
	<!-- wp:query-pagination-numbers /-->
	<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->
