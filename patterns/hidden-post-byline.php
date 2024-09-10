<?php

/**
 * Title: Post Byline
 * Slug: blogwheels/post-byline
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

	<!-- wp:group {
		"metadata":{
			"name":"<?= esc_attr__('Post Author', 'blogwheels') ?>"
		},
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|minus-3"
			}
		},
		"layout":{
			"type":"flex",
			"flexWrap":"nowrap"
		}
	} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {
			"metadata":{
				"name":"<?= esc_attr__('Prefix', 'blogwheels') ?>"
			}
		} -->
		<p><?= esc_html__('By', 'blogwheels') ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:post-author-name {"isLink":true} /-->
	</div>
	<!-- /wp:group -->

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
