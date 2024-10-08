/**
 * List marker component.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import { markerIcon } from "../../common/utils-icon";
import { UL_MARKERS, OL_MARKERS } from "./constants";

import {
	getMarkerFromClassName,
	isOrderedMarker,
	isUnorderedMarker,
	updateMarkerClass,
} from "./utils";

// WordPress dependencies.
import { __ } from "@wordpress/i18n";
import { useEffect, useMemo } from "@wordpress/element";

import {
	Dropdown,
	FlexItem,
	MenuGroup,
	MenuItem,
	ToolbarButton,
} from "@wordpress/components";

// Define a default option for the select control.
const DEFAULT_OPTION = {
	value: "",
	label: __("Default", "blogwheels"),
};

/**
 * Creates a list marker dropdown control.
 * @example
 * <MarkerDropdownControl
 * 	attributes={props.attributes}
 * 	setAttributes={props.setAttributes}
 * />
 */
export default ({ attributes: { className, ordered }, setAttributes }) => {
	// Get the marker and only update it when `className` changes.
	const marker = useMemo(() => getMarkerFromClassName(className), [className]);

	// Gets the marker options based on the list element.
	const options = useMemo(
		() =>
			ordered
				? [DEFAULT_OPTION, ...OL_MARKERS]
				: [DEFAULT_OPTION, ...UL_MARKERS],
		[ordered],
	);

	// Resets the marker class if the list element changes.
	useEffect(() => {
		if (
			(marker && ordered && !isOrderedMarker(marker)) ||
			(!ordered && !isUnorderedMarker(marker))
		) {
			setAttributes({
				className: updateMarkerClass(className, "", marker),
			});
		}
	}, [ordered]);

	const markerButtonContent = (option, index) => {
		const slug = option.value ? option.value : "default";

		return (
			<FlexItem
				key={`blockwheels-marker-name-${index}`}
				className="blockwheels-list-marker-selector__content"
			>
				<ul className={`blockwheels-list-marker-selector__list has-marker-${slug}`}>
					<li>{option.label}</li>
				</ul>
			</FlexItem>
		);
	};

	const markerButton = (option, index) => (
		<MenuItem
			key={index}
			role="menuitemradio"
			className="blockwheels-list-marker-selector__button"
			isSelected={marker === option.value}
			isPressed={marker === option.value}
			onClick={() =>
				setAttributes({
					className: updateMarkerClass(className, option.value, marker),
				})
			}
		>
			{markerButtonContent(option, index)}
		</MenuItem>
	);

	const markerControls = (
		<MenuGroup
			className="blockwheels-list-marker-selector"
			label={__("Select a list marker", "blogwheels")}
		>
			{options.map((option, index) => markerButton(option, index))}
		</MenuGroup>
	);

	return (
		<Dropdown
			className="blockwheels-list-marker-dropdown"
			contentClassName="blockwheels-list-marker-popover"
			popoverProps={{ placement: "bottom-start" }}
			renderToggle={({ isOpen, onToggle }) => (
				<ToolbarButton
					className="blockwheels-list-marker__button"
					icon={markerIcon}
					label={__("List Marker", "blogwheels")}
					onClick={onToggle}
					aria-expanded={isOpen}
					isPressed={!!marker}
				/>
			)}
			renderContent={() => markerControls}
		/>
	);
};
