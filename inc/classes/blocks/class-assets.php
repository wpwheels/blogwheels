<?php
/**
 * The Assets class handles actions and filters that are needed for running on
 * the frontend of a website.
 *
 *
 * @copyright Copyright (c) 2023-2024, WPWheels
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wpwheels/blogwheels
 */

declare(strict_types=1);

namespace BLOGWHEELS\Inc\Blocks;

use FilesystemIterator;
use BLOGWHEELS\Inc\Traits\Singleton;

# Prevent direct access.
defined('ABSPATH') || exit;

/**
 * Class Assets.
 */
class Assets {

	use Singleton;

	/**
     * Stores the supported block namespaces that we use for block stylesheets.
     *
     * @since 1.0.0
     * @var   string[]
     */
    protected const NAMESPACES = [
        'core'
    ];

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->setup_hooks();
	}

	/**
	 * Initialize hooks.
	 */
	private function setup_hooks() {

		// Hook into WordPress.
        add_action('init', [$this, 'enqueueStyles'], 99);
	}

	/**
     * Enqueues block-specific styles so that they only load when the block
     * is in use. Block styles stored under `/assets/css/blocks` are
     * automatically enqueued. Each file should be named
     * `{$block_namespace}/{$block_slug}.css`.
     *
     * @since 1.0.0
     */
    public function enqueueStyles(): void
    {
        // Loop through each of the block namespace paths, get their stylesheets, and enqueue them.
        foreach (self::NAMESPACES as $namespace) {
            $path = get_parent_theme_file_path("public/css/blocks/{$namespace}");
            if (!is_dir($path)) {
                continue;
            }

            $files = new FilesystemIterator($path);

            foreach ($files as $file) {
                if (!$file->isDir() && 'css' === $file->getExtension()) {
                    $this->enqueueStyle($namespace, $file->getBasename('.css'));
                }
            }
        }
    }

    /**
     * Enqueues an individual block stylesheet based on a given block
     * namespace and slug.
     *
     * @since 1.0.0
     */
    private function enqueueStyle(string $namespace, string $slug): void
    {
        // Build a relative path and URL string.
        $relative = "public/css/blocks/{$namespace}/{$slug}";

        // Bail if the asset file doesn't exist.
        if (!file_exists(get_parent_theme_file_path("{$relative}.asset.php"))) {
            return;
        }

        // Get the asset file.
        $asset = include get_parent_theme_file_path("{$relative}.asset.php");

        // Register the block style.
        wp_enqueue_block_style("{$namespace}/{$slug}", [
            'handle' => "blogwheels-block-{$namespace}-{$slug}",
            'src'    => get_parent_theme_file_uri("{$relative}.css"),
            'path'   => get_parent_theme_file_path("{$relative}.css"),
            'deps'   => $asset['dependencies'],
            'ver'    => $asset['version']
        ]);
    }
}
