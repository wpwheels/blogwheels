<?php

/**
 * The Style Variations class registers block style variations via PHP.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Block;

use WP_Block_Styles_Registry;
use BLOGWHEELS\Contracts\Bootable;
use BLOGWHEELS\Tools\Hooks\{Action, Hookable};

class StyleVariations implements Bootable
{
	use Hookable;

	/**
	 * Sets up the object state.
	 *
	 * @since 1.0.0
	 */
	public function __construct(protected WP_Block_Styles_Registry $styles)
	{}

	/**
	 * Boots the component, running its actions/filters.
	 *
	 * @since 1.0.0
	 */
	#[\Override]
	public function boot(): void
	{
		$this->hookMethods();
	}

	/**
	 * Register custom block styles.
	 *
	 * @since 1.0.0
	 */
	#[Action('init')]
	public function register(): void
	{
		foreach ($this->getCustomStyles() as $block => $styles) {
			foreach ($styles as $name => $label) {
				$this->styles->register($block, [
					'name'  => $name,
					'label' => $label
				]);
			}
		}
	}

	/**
	 * Returns an array of custom block style variations to register.
	 *
	 * @since 1.0.0
	 */
	private function getCustomStyles(): array
	{
		// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
		return [
			'core/archives' => [
				'horizontal' => __('Horizontal', 'blogwheels'),
				'pull'       => __('Pull',       'blogwheels'),
				'spread'     => __('Spread',     'blogwheels')
			],
			'core/button' => [
				'link' => __('Link', 'blogwheels')
			],
			'core/categories' => [
				'horizontal' => __('Horizontal', 'blogwheels'),
				'pull'       => __('Pull',       'blogwheels'),
				'spread'     => __('Spread',     'blogwheels')
			],
			'core/code' => [
				'highlight' => __('Highlight', 'blogwheels')
			],
			'core/columns' => [
				'grid-auto'     => __('Grid: Auto',           'blogwheels'),
				'reverse-stack' => __('Reverse Mobile Stack', 'blogwheels'),
			],
			'core/comment-author-name' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/comment-date' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/comment-edit-link' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/comment-reply-link' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/cover' => [
				'fade-in' => __('Fade In', 'blogwheels'),
				'stretch' => __('Stretch', 'blogwheels')
			],
			'core/details' => [
				'plain' => __('Plain', 'blogwheels')
			],
			'core/file' => [
				'icon'  => __('Icon',  'blogwheels'),
				'plain' => __('Plain', 'blogwheels')
			],
			'core/footnotes' => [
				'pull' => __('Pull', 'blogwheels')
			],
			'core/gallery' => [
				'classic' => __('Classic', 'blogwheels'),
				'reverse' => __('Reverse', 'blogwheels')
			],
			'core/heading' => [
				'knockout'          => __('Knockout',      'blogwheels'),
				'text-wrap-balance' => __('Wrap: Balance', 'blogwheels')
			],
			'core/home-link' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/image' => [
				'borderless' => __('Borderless',   'blogwheels'),
				'hand-drawn' => __('Hand-Drawn',   'blogwheels'),
				'icon'       => __('Caption Icon', 'blogwheels'),
				'polaroid'   => __('Polaroid',     'blogwheels'),
				'tape'       => __('Tape',         'blogwheels')
			],
			'core/list' => [
				'horizontal' => __('Horizontal', 'blogwheels'),
				'pull'       => __('Pull',       'blogwheels')
			],
			'core/list-item' => [
				'cancel-circle' => __('Cancel Circle', 'blogwheels'),
				'check-circle'  => __('Check Circle',  'blogwheels')
			],
			'core/loginout' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/page-list' => [
				'horizontal' => __('Horizontal', 'blogwheels'),
				'pull'       => __('Pull',       'blogwheels')
			],
			'core/paragraph' => [
				'indent'  => __('Indent',  'blogwheels'),
				'lead-in' => __('Lead-in', 'blogwheels'),
				'lede'    => __('Lede',    'blogwheels')
			],
			'core/post-author-name' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/post-comments-count' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/post-comments-form' => [
				'icons' => __('Icons', 'blogwheels')
			],
			'core/post-comments-link' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/post-featured-image' => [
				'borderless' => __('Borderless', 'blogwheels')
			],
			'core/post-date' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/post-template' => [
				'flex' => __('Flexible', 'blogwheels')
			],
			'core/post-terms' => [
				'fill'    => __('Fill', 'blogwheels'),
				'icon'    => __('Icon', 'blogwheels'),
				'outline' => __('Outline', 'blogwheels')
			],
			'core/post-time-to-read' => [
				'icon' => __('Icon', 'blogwheels')
			],
			'core/pullquote' => [
				'mark-top' => __('Mark: Top', 'blogwheels')
			],
			'core/search' => [
				'icon' => __('Icon',  'blogwheels'),
				'sm'   => __('Small', 'blogwheels')
			],
			'core/separator' => [
				'dashed'     => __('Dashed',     'blogwheels'),
				'dotted'     => __('Dotted',     'blogwheels'),
				'double'     => __('Double',     'blogwheels'),
				'hand-drawn' => __('Hand Drawn', 'blogwheels')
			],
			'core/social-links' => [
				'fill'     => __('Fill',     'blogwheels'),
				'monotone' => __('Monotone', 'blogwheels'),
				'outline'  => __('Outline',  'blogwheels')
			],
			'core/site-title' => [
				'normalize' => __('Normalize', 'blogwheels')
			],
			'core/table-of-contents' => [
				'chapters' => __('Chapters', 'blogwheels'),
				'pull'     => __('Pull',     'blogwheels')
			],
			'core/tag-cloud' => [
				'fill' => __('Fill', 'blogwheels'),
				'flat' => __('Flat', 'blogwheels'),
				'icon' => __('Icon', 'blogwheels')
			]
		];
		// phpcs:enable
	}
}
