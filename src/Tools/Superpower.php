<?php

/**
 * Class for randomly generating a "powered by" message.
 *
 *
 * @copyright Copyright (c) 2022-2024, WPWheels
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Ideas\Tools;

class Superpower
{
	/**
	 * Holds the potential messages.
	 *
	 * @since 1.0.0
	 */
	protected array $messages = [];

	/**
	 * Sets the initial object state.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->messages['text'] = [
			__('Powered by heart and soul.', 'blogwheels'),
			__('Powered by crazy ideas and passion.', 'blogwheels'),
			__('Powered by the thing that holds all things together in the universe.', 'blogwheels'),
			__('Powered by love.', 'blogwheels'),
			__('Powered by the vast and endless void.', 'blogwheels'),
			__('Powered by the code of a maniac.', 'blogwheels'),
			__('Powered by peace and understanding.', 'blogwheels'),
			__('Powered by coffee.', 'blogwheels'),
			__('Powered by sleepless nights.', 'blogwheels'),
			__('Powered by the love of all things.', 'blogwheels'),
			__('Powered by something greater than myself.', 'blogwheels'),
			// 2022-10-05 - @justintadlock
			__('Powered by elbow grease. Held together by tape and bubble gum.', 'blogwheels'),
			__('Powered by an old mixtape and memories of lost love.', 'blogwheels'),
			__('Powered by thoughts of old love letters.', 'blogwheels')
		];

		// @todo Come up with emoji equivalents for the messages that
		// are commented out.
		$this->messages['emoji'] = [
			__('Powered by ❤️ and soul.', 'blogwheels'),
			__('Powered by crazy 🤔 and passion.', 'blogwheels'),
		//	__('Powered by the thing that holds all things together in the universe.', 'blogwheels'),
			__('Powered by ❤️.', 'blogwheels'),
		//	__('Powered by the vast and endless void.', 'blogwheels'),
		//	__('Powered by the code of a maniac.', 'blogwheels'),
			__('Powered by ☮️ and understanding.', 'blogwheels'),
			__('Powered by ☕.', 'blogwheels'),
			__('Powered by sleepless 🌛.', 'blogwheels'),
			__('Powered by ❤️ for all things.', 'blogwheels'),
		//	__('Powered by something greater than myself.', 'blogwheels'),
			// 2022-10-05 - @justintadlock
		//	__('Powered by elbow grease. Held together by tape and bubble gum.', 'blogwheels'),
			__('Powered by an old mix 💿 and memories of 💔.', 'blogwheels'),
			__('Powered by thoughts of old 💌.', 'blogwheels')
		];
	}

	/**
	 * Returns the message.
	 *
	 * @since 1.0.0
	 */
	public function text(string $type = ''): string
	{
		$collection = match ($type) {
			'text'  => $this->messages['text'],
			'emoji' => $this->messages['emoji'],
			default => [
				...$this->messages['text'],
				...$this->messages['emoji']
			]
		};

		return $collection[ array_rand($collection, 1) ];
	}

	/**
	 * Returns the default messages.
	 *
	 * @since 1.0.0
	 */
	public function messages(): array
	{
		return $this->messages;
	}
}
