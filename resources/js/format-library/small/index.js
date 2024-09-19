/**
 * Creates the small RichText format type.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2024, Justin Tadlock
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import { textDecreaseIcon } from '../../common/utils-icon';

// WordPress dependencies.
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { __ }                    from '@wordpress/i18n';
import { toggleFormat }          from '@wordpress/rich-text';

/**
 * Name of the format.
 * @type {string}
 */
const name = 'blogwheels/small';

/**
 * RichText format type definition.
 * @type {object}
 */
export default {
	name,
	title: __('Small', 'blogwheels'),
	tagName: 'small',
	className: null,
	edit: ({ isActive, onChange, value }) => (
		<RichTextToolbarButton
			icon={ textDecreaseIcon }
			title={ __('Small', 'blogwheels') }
			isActive={ isActive }
			onClick={ () => onChange(
				toggleFormat(value, { type: name })
			) }
		/>
	)
};
