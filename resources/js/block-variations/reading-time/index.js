/**
 * Reading Time variation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2024, Justin Tadlock
 * @license   GPL-3.0-or-later
 */

import { timerIcon } from '../../common/utils-icon';
import { __, sprintf } from '@wordpress/i18n';

export default {
	block: 'core/paragraph',
	variation: {
		name:       'blogwheels/post',
		title:      __('Reading Time', 'blogwheels'),
		description: __('Displays the estimated time to read the post.', 'blogwheels'),
		category:   'theme',
		keywords:   [ 'time', 'read', 'reading' ],
		icon:       timerIcon,
		scope:      [ 'inserter' ],
		attributes: {
			metadata: {
				bindings: {
					content: {
						source: 'blogwheels/post',
						args: {
							key: 'readingTime'
						}
					}
				}
			},
			placeholder: __('Reading Time', 'blogwheels')
		},
		example: {},
		isActive: [
			'metadata.bindings.content.source',
			'metadata.bindings.content.args.key'
		]
	}
};
