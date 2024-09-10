<?php

/**
 * Title: Post Byline With Avatar
 * Slug: blogwheels/post-byline-avatar
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{
		"name":"<?= esc_attr__('Post Byline', 'blogwheels') ?>"
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
	"className": "is-style-meta"
} -->
<div class="wp-block-group is-style-meta">

	<!-- wp:avatar {"size":48,"isLink":true} /-->

	<!-- wp:post-author-name {"isLink":true} /-->

	<!-- wp:paragraph {
		"metadata":{
			"name":"<?= esc_attr__('Separator', 'blogwheels') ?>"
		}
	} -->
	<p><?=
		// Translators: Metadata separator.
		esc_html__('&middot;', 'blogwheels')
	?></p>
	<!-- /wp:paragraph -->

	<!-- wp:post-date /-->

</div>
<!-- /wp:group -->
