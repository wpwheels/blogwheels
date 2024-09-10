<?php

/**
 * Title: 404 Template
 * Slug: blogwheels/template-404
 * Inserter: no
 * Template Types: 404
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:template-part {"slug":"header","className":"site-header"} /-->

<!-- wp:group {
	"tagName":"main",
	"metadata":{"name":"<?= esc_attr__('Content', 'blogwheels') ?>"},
	"style":{
		"spacing":{
			"blockGap":"0"
		}
	},
	"layout":{"type":"default"}
} -->
<main class="wp-block-group">

	<!-- wp:group {
		"tagName":"article",
		"style":{
			"spacing":{
				"padding":{
					"top":"var:preset|spacing|plus-3",
					"bottom":"var:preset|spacing|plus-3"
				}
			}
		}
	} -->
	<article class="wp-block-group" style="padding-top:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-3)">

		<!-- wp:group {
			"tagName":"header",
			"style":{"spacing":{"blockGap":"0"}},
			"layout":{"type":"constrained"}
		} -->
		<header class="wp-block-group">
			<!-- wp:heading {"level":1} -->
			<h1 class="wp-block-heading">
				<?= esc_html__('404: Nothing Found', 'blogwheels') ?>
			</h1>
			<!-- /wp:heading -->
		</header>
		<!-- /wp:group -->

		<!-- wp:group {
			"layout":{"type":"constrained"},
			"className":"is-style-prose"
		} -->
		<div class="wp-block-group is-style-prose">

			<!-- wp:paragraph -->
			<p><?= esc_html__('It looks like you stumbled upon a page that does not exist. Perhaps rolling the dice with a search might help:', 'blogwheels') ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:search {
				"label":"<?= esc_html__('Search', 'blogwheels') ?>",
				"showLabel":false,
				"placeholder":"<?= esc_attr__('Enter search terms...', 'blogwheels') ?>",
				"buttonText":"<?= esc_html__('Search', 'blogwheels') ?>",
				"buttonPosition":"button-inside"
			} /-->

		</div>
		<!-- /wp:group -->

	</article>
	<!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","className":"site-footer"} /-->
