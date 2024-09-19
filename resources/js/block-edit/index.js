/**
 * Registers block edit filters.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2024, Justin Tadlock
 * @license   GPL-3.0-or-later
 */

// Internal dependencies.
import withCodeLanguage       from './code-language';
import withGradientBackground from './gradient-background';
import withListMarker         from './list-marker';

// WordPress dependencies.
import { addFilter } from '@wordpress/hooks';

// Add filters.
addFilter('editor.BlockEdit', 'blogwheels-code-language',       withCodeLanguage);
addFilter('editor.BlockEdit', 'blogwheels-gradient-background', withGradientBackground);
addFilter('editor.BlockEdit', 'blogwheels-list-marker',         withListMarker);
