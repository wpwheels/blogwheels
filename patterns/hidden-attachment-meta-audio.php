<?php

/**
 * Title: Attachment Meta: Audio
 * Slug: blogwheels/attachment-meta-audio
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$fields = [
	'length_formatted' => __('Run Time:', 'blogwheels'),
	'artist'           => __('Artist:', 'blogwheels'),
	'album'            => __('Album:', 'blogwheels'),
	'track_number'     => __('Track:', 'blogwheels'),
	'year'             => __('Year:', 'blogwheels'),
	'genre'            => __('Genre:', 'blogwheels'),
	'mime_type'        => __('Mime Type:', 'blogwheels'),
	'file_size'        => __('Size:', 'blogwheels')
];

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Media Data', 'blogwheels') ?>"},
	"style":{"spacing":{"blockGap":"var:preset|spacing|base"}},
	"align":"full",
	"layout":{"type":"constrained"}
} -->
<div class="wp-block-group alignfull">

	<!-- wp:heading {"className":"screen-reader-text"} -->
	<h2 class="wp-block-heading screen-reader-text"><?= esc_html__('Audio Data', 'blogwheels') ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {
		"templateLock":"insert",
		"style":{"spacing":{"blockGap":"var:preset|spacing|minus-3"}},
		"layout":{"type":"default"}
	} -->
	<div class="wp-block-group">

		<?php foreach ($fields as $key => $label) : ?>

			<!-- wp:paragraph {
				"metadata":{
					"name":"<?= sprintf(
						// Translators: %s is the metadata label.
						esc_attr__('%s Media Meta', 'blogwheels'),
						esc_attr($label)
					) ?>",
					"bindings":{
						"content":{
							"source":"blockwheels/media",
							"args":{
								"key":"<?= esc_attr($key) ?>",
								"label":"<?= esc_attr($label) ?>"
							}
						}
					},
					"@ifAttribute":"content"
				},
				"placeholder":"<?= esc_attr__('Connected to a custom field', 'blogwheels') ?>",
				"fontSize":"sm",
				"className":"media-data"
			} -->
			<p class="has-sm-font-size media-data"></p>
			<!-- /wp:paragraph -->

		<?php endforeach ?>

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
