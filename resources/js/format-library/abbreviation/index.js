/**
 * Creates the abbreviation RichText format type.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2024, Justin Tadlock
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import { abbreviationIcon } from '../../common/utils-icon';

// WordPress dependencies.
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { useState }              from '@wordpress/element';
import { __ }                    from '@wordpress/i18n';
import { Popover, TextControl }  from '@wordpress/components';

import {
	applyFormat,
	removeFormat,
	useAnchor
} from '@wordpress/rich-text';

/**
 * Name of the format.
 * @type {string}
 */
const name = 'blogwheels/abbr';

/**
 * RichText format type definition.
 * @type {object}
 */
const abbreviationFormat = {
	name,
	title:     __('Abbreviation', 'blogwheels'),
	tagName:   'abbr',
	className: null,
	edit:      Edit
};

/**
 * RichText format type definition.
 * @type {object}
 */
export default abbreviationFormat;

/**
 * Creates the format type edit component.
 */
function Edit({ isActive, onChange, value, contentRef })
{
	const [ isPopoverVisible, setIsPopoverVisible ] = useState(false);

	const togglePopover = () => setIsPopoverVisible((state) => ! state);

	return (
		<>
			<RichTextToolbarButton
				icon={ abbreviationIcon }
				title={ __('Abbreviation', 'blogwheels') }
				isActive={ isActive }
				onClick={ () =>
					isActive
					? onChange(removeFormat(value, name))
					: togglePopover()
				}
			/>
			{ isPopoverVisible && (
				<AbbrTitlePopover
					value={ value }
					onChange={ onChange }
					onClose={ togglePopover }
					contentRef={ contentRef }
				/>
			) }
		</>
	);
};

/**
 * Creates the popover component.
 */
function AbbrTitlePopover({ value, contentRef, onChange, onClose })
{
	const popoverAnchor = useAnchor({
		editableContentElement: contentRef.current,
		settings: abbreviationFormat,
	});

	const [ title, setTitle ] = useState('');

	const titleTextControl = (
		<TextControl
			label={ __('Add title for abbreviation', 'blogwheels') }
			value={ title }
			onChange={ (val) => setTitle(val) }
			help={
				__('Expand on the definition for the abbreviation when a full description is not present in the content.', 'blogwheels')
			}
		/>
	);

	const popoverForm = (
		<form
			className="blogwheels-format-abbr-popover__form"
			onSubmit={ (event) => {
				event.preventDefault();
				onChange(applyFormat(value, {
					type: name,
					attributes: { title },
				}));
				onClose();
			} }
		>
			{ titleTextControl }
		</form>
	);

	return (
		<Popover
			className="blogwheels-format-abbr-popover"
			anchor={ popoverAnchor }
			placement="top"
			onClose={ onClose }
			variant="toolbar"
		>
			{ popoverForm }
		</Popover>
	);
};
