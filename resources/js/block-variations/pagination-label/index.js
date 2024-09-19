/**
 * Query pagination label variation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2024, Justin Tadlock
 * @license   GPL-3.0-or-later
 */

import { labelImportantIcon } from '../../common/utils-icon';
import { __, sprintf } from '@wordpress/i18n';

export default {
	block: 'core/paragraph',
	variation: {
		name:        'blogwheels/pagination-label',
		title:       __('Pagination Label', 'blogwheels'),
		description: __('Displays the pagination current and total pages.', 'blogwheels'),
		category:    'theme',
		icon:        labelImportantIcon,
		scope:       [ 'inserter' ],
		attributes:  {
			metadata: {
				bindings: {
					content: {
						source: 'blogwheels/theme',
						args: {
							key: 'paginationLabel'
						}
					}
				}
			},
			placeholder: sprintf(__('Page %1$s / %2$s:', 'blogwheels'), 3, 7),
			className: "pagination-label"
		},
		isActive: [
			'metadata.bindings.content.source',
			'metadata.bindings.content.args.key'
		]
	}
};
