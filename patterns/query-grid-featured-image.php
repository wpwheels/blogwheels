<?php

/**
 * Title: Post Grid: Featured Image
 * Slug: blogwheels/query-grid-featured-image
 * Description: Displays the queried posts in a three-column grid of featured images.
 * Categories: portfolio, posts
 * Keywords: query, cover, grid, posts
 * Block Types: core/query
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:query {
	"metadata":{"name":"<?= esc_attr__('Posts Query', 'blogwheels') ?>"},
	"queryId":1,
	"query":{
		"perPage":6,
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
	"className":"alignfull",
	"layout":{"type":"constrained"},
	"style":{
		"spacing":{
			"padding":{
				"right":"0",
				"left":"0",
				"top":"var:preset|spacing|px",
				"bottom":"var:preset|spacing|px"
			},
			"blockGap":"0"
		}
	}
} -->
<div class="wp-block-query alignfull" style="padding-top:var(--wp--preset--spacing--px);padding-right:0;padding-bottom:var(--wp--preset--spacing--px);padding-left:0">

	<!-- wp:post-template {
		"align":"full",
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|px"
			}
		},
		"layout":{
			"type":"grid",
			"columnCount":3
		}
	} -->
		<!-- wp:post-featured-image {
			"isLink":true,
			"aspectRatio":"1",
			"style":{
				"border":{
					"radius":"0px"
				}
			},
			"className":"is-style-borderless"
		} /-->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination {
		"paginationArrow":"arrow",
		"style":{
			"spacing":{
				"margin":{
					"top":"0"
				},
				"padding":{
					"top":"var:preset|spacing|plus-3",
					"right":"var:preset|spacing|plus-3",
					"bottom":"var:preset|spacing|plus-3",
					"left":"var:preset|spacing|plus-3"
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
