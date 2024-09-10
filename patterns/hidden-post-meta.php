<?php

/**
 * Title: Post Meta
 * Slug: blogwheels/post-meta
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"footer",
	"metadata":{
		"name":"<?= esc_attr__('Post Footer', 'blogwheels') ?>"
	},
	"style":{
		"spacing":{
			"blockGap":"0"
		}
	},
	"layout":{
		"type":"constrained"
	},
	"className":"is-style-meta"
} -->
<footer class="wp-block-group is-style-meta">
	<!-- wp:post-terms {"term":"category","className":"is-style-icon"} /-->
	<!-- wp:post-terms {"term":"post_tag","className":"is-style-icon"} /-->
</footer>
<!-- /wp:group -->
