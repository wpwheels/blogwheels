<?php

/**
 * Title: Call to Action
 * Slug: blogwheels/call-to-action
 * Categories: banner, call-to-action, text
 * Block Types: blogwheels/call-to-action
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

use BLOGWHEELS\Inc\Helpers\Utils;

?>
<!-- wp:group {
	"align":"wide",
	"className":"is-style-section-1",
	"style":{
		"typography":{
			"textAlign":"center"
		}
	},
	"layout":{
		"type":"constrained"
	}
} -->
<div class="wp-block-group has-text-align-center alignwide is-style-section-1">

    <!-- wp:heading -->
    <h2 class="wp-block-heading"><?= esc_html__('Placeholder Heading', 'blogwheels') ?></h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p><?= esc_html(Language::loremIpsum()) ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {
		"layout":{
			"type":"flex",
			"justifyContent":"center"
		}
	} -->
    <div class="wp-block-buttons">
        <!-- wp:button -->
        <div class="wp-block-button"><a
                class="wp-block-button__link wp-element-button"><?= esc_html__('Placeholder Button', 'blogwheels')?></a>
        </div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

</div>
<!-- /wp:group -->
