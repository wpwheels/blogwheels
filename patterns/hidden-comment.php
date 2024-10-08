<?php

/**
 * Title: Comment
 * Slug: blogwheels/comment
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"article",
	"metadata":{"name":"<?= esc_attr__('Comment', 'blogwheels') ?>"},
	"layout":{"type":"default"}
} -->
<article class="wp-block-group">

	<!-- wp:group {
		"tagName":"header",
		"metadata":{
			"name":"<?= esc_attr__('Comment Header', 'blogwheels') ?>"
		},
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|base"
			}
		},
		"layout":{
			"type":"flex",
			"flexWrap":"wrap"
		},
		"className":"is-style-meta"
	} -->
	<header class="wp-block-group is-style-meta">

		<?php if (get_option('thread_comments')) : ?>

			<!-- wp:paragraph {
				"placeholder":"<?= esc_attr__('In reply to Comment Author', 'blogwheels') ?>",
				"metadata":{
					"bindings":{
						"content":{
							"source":"blockwheels/comment",
							"args":{
								"key":"parentLink"
							}
						}
					},
					"@ifAttribute":"content"
				},
				"style":{
					"layout":{
						"selfStretch":"fixed",
						"flexSize":"100%"
					}
				},
				"className":"comment-parent-link"
			} -->
			<p class="comment-parent-link"></p>
			<!-- /wp:paragraph -->

		<?php endif ?>

		<!-- wp:avatar {
			"size":56,
			"style":{
				"layout":{
					"selfStretch":"fit",
					"flexSize":null
				}
			}
		} /-->

		<!-- wp:group {
			"metadata":{"name":"<?= esc_attr__('Comment Meta', 'blogwheels') ?>"},
			"layout":{"type":"default"}
		} -->
		<div class="wp-block-group">

			<!-- wp:comment-author-name /-->

			<!-- wp:group {
				"style":{
					"spacing":{
						"margin":{
							"top":"0px",
							"bottom":"0px"
						},
						"blockGap":"var:preset|spacing|base"
					}
				},
				"layout":{"type":"flex"}
			} -->
			<div class="wp-block-group" style="margin-top:0px;margin-bottom:0px">
				<!-- wp:comment-date /-->
				<!-- wp:comment-edit-link /-->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:group -->

	</header>
	<!-- /wp:group -->

	<!-- wp:comment-content /-->

	<!-- wp:group {
		"tagName":"footer",
		"metadata":{"name":"<?= esc_attr__('Comment Footer', 'blogwheels') ?>"},
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|minus-2"
			}
		},
		"className":"is-style-meta",
		"layout":{
			"type":"flex",
			"flexWrap":"nowrap",
			"justifyContent":"right"
		}
	} -->
	<footer class="wp-block-group is-style-meta">
		<!-- wp:comment-reply-link /-->
	</footer>
	<!-- /wp:group -->

</article>
<!-- /wp:group -->

