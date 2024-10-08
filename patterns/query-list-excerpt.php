<?php

/**
 * Title: Post List: Excerpt
 * Slug: blogwheels/query-list-excerpt
 * Categories: posts
 * Keywords: query, posts
 * Block Types: core/query
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:query {
	"metadata":{"name":"<?= esc_attr__('Posts Query', 'blogwheels') ?>"},
	"queryId":0,
	"query":{
		"perPage":3,
		"pages":0,
		"offset":0,
		"postType":"post",
		"order":"desc",
		"orderBy":"date",
		"author":"",
		"search":"",
		"exclude":[],
		"sticky":"",
		"inherit":true,
		"taxQuery":null,
		"parents":[]
	},
	"align":"full",
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|plus-6",
			"padding":{
				"top":"var:preset|spacing|plus-6",
				"right":"var:preset|spacing|plus-3",
				"bottom":"var:preset|spacing|plus-6",
				"left":"var:preset|spacing|plus-3"
			}
		}
	},
	"layout":{"type":"constrained"}
} -->
<div class="wp-block-query alignfull" style="padding-top:var(--wp--preset--spacing--plus-6);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-6);padding-left:var(--wp--preset--spacing--plus-3)">

	<!-- wp:post-template {
		"align":"full",
		"style":{"spacing":{"blockGap":"var:preset|spacing|plus-6"}},
		"layout":{"type":"constrained"}
	} -->

		<!-- wp:pattern {"slug":"blogwheels/post-excerpt"} /-->

	<!-- /wp:post-template -->

	<!-- wp:query-pagination {
		"paginationArrow":"arrow",
		"align":"center",
		"style":{
			"spacing":{
				"margin":{
					"top":"var:preset|spacing|plus-6"
				}
			}
		},
		"layout":{
			"type":"flex",
			"justifyContent":"right"
		}
	} -->
		<!-- wp:paragraph {
			"metadata":{
				"bindings":{
					"content":{
						"source":"blockwheels/theme",
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

</div>
<!-- /wp:query -->
