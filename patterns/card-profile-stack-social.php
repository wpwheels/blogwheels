<?php

/**
 * Title: Vertical Social Profile Card
 * Slug: blogwheels/card-profile-stack-social
 * Categories: team, blogwheels-card
 * Keywords: card, grid, profile, social, team
 * Viewport Width: 480
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

use BLOGWHEELS\Inc\Helpers\Utils;

?>
<!-- wp:group {
	"metadata":{
		"name":"<?= esc_attr__('Card', 'blogwheels') ?>"
	},
	"className":"has-global-border is-style-section-1",
	"style":{
		"spacing":{
			"padding":{
				"bottom":"0",
				"left":"0",
				"right":"0",
				"top":"0"
			},
			"blockGap":"0"
		},
		"typography":{
			"textAlign":"center"
		}
	},
	"fontSize":"sm",
	"layout":{
		"type":"flex",
		"orientation":"vertical",
		"justifyContent":"stretch",
		"verticalAlignment":"space-between"
	}
} -->
<div class="wp-block-group has-text-align-center has-global-border is-style-section-1 has-sm-font-size" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

	<!-- wp:group {
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|base",
				"padding":{
					"top":"var:preset|spacing|plus-3",
					"bottom":"var:preset|spacing|plus-3",
					"left":"var:preset|spacing|plus-3",
					"right":"var:preset|spacing|plus-3"
				}
			},
			"layout":{
				"selfStretch":"fill",
				"flexSize":null
			}
		},
		"layout":{
			"type":"flex",
			"orientation":"vertical",
			"justifyContent":"center"
		}
	} -->
	<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--plus-3);padding-right:var(--wp--preset--spacing--plus-3);padding-bottom:var(--wp--preset--spacing--plus-3);padding-left:var(--wp--preset--spacing--plus-3)">

		<!-- wp:avatar {
			"userId":null,
			"isLink":true,
			"className":""
		} /-->

		<!-- wp:group {
			"metadata":{
				"name":"<?= esc_attr__('Card Content', 'blogwheels') ?>"
			},
			"style":{
				"spacing":{
					"blockGap":"0"
				}
			},
			"layout":{
				"type":"default"
			}
		} -->
		<div class="wp-block-group">

			<!-- wp:heading {
				"level":3,
				"fontSize":"lg"
			} -->
			<h3 class="wp-block-heading has-lg-font-size"><?= esc_html__('User Name', 'blogwheels') ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?= esc_html(Utils::loremIpsum(8)) ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {
		"tagName":"footer",
		"metadata":{
			"name":"<?= esc_attr__('Card Footer', 'blogwheels') ?>"
		},
		"className":"is-style-section-2",
		"style":{
			"spacing":{
				"padding":{
					"top":"var:preset|spacing|base",
					"bottom":"var:preset|spacing|base"
				}
			}
		},
		"layout":{
			"type":"default"
		}
	} -->
	<footer class="wp-block-group is-style-section-2" style="padding-top:var(--wp--preset--spacing--base);padding-bottom:var(--wp--preset--spacing--base)">

		<!-- wp:social-links {
			"size":"has-huge-icon-size",
			"lock":{
				"move":true,
				"remove":true
			},
			"className":"is-style-monotone",
			"style":{
				"spacing":{
					"blockGap":{
						"top":"var:preset|spacing|minus-3",
						"left":"var:preset|spacing|minus-3"
					}
				}
			},
			"layout":{
				"type":"flex",
				"justifyContent":"center"
			}
		} -->
		<ul class="wp-block-social-links has-huge-icon-size is-style-monotone">
			<!-- wp:social-link {"url":"https://wordpress.org","service":"wordpress"} /-->
			<!-- wp:social-link {"url":"https://github.com","service":"github"} /-->
			<!-- wp:social-link {"url":"https://facebook.com","service":"facebook"} /-->
			<!-- wp:social-link {"url":"https://twitter.com","service":"twitter"} /-->
			<!-- wp:social-link {"url":"https://twitch.tv","service":"twitch"} /-->
		</ul>
		<!-- /wp:social-links -->

	</footer>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
