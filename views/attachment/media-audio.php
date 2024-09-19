<?php
/**
 * Dynamic pattern for handling audio attachment media.
 *
 *
 * @copyright 2023 WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$caption = wp_get_attachment_caption($data['post_id']);
$src     = wp_get_attachment_url($data['post_id']);

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">

    <!-- wp:audio {"id":<?= absint($data['post_id']) ?>} -->
    <figure class="wp-block-audio">
        <audio controls src="<?= esc_url($src) ?>"></audio>

        <?php if ($caption) : ?>
        <figcaption class="wp-element-caption"><?= esc_html($caption) ?></figcaption>
        <?php endif ?>
    </figure>
    <!-- /wp:audio -->

</div>
<!-- /wp:group -->