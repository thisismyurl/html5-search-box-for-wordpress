<?php
/**
 * Plugin Name:       HTML5 Search for WordPress
 * Plugin URI:        https://thisismyurl.com/plugins/html5-search-for-wordpress/
 * Description:       Ensures HTML5 search-form markup is enabled for any active theme that has not declared HTML5 theme support.
 * Version:           16.0.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Christopher Ross
 * Author URI:        https://thisismyurl.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       html5-search-box-for-wordpress
 *
 * @package ThisIsMyURL\HTML5Search
 */

declare( strict_types = 1 );

namespace ThisIsMyURL\HTML5Search;

defined( 'ABSPATH' ) || exit;

const VERSION = '16.0.0';

/**
 * Ensure HTML5 search-form theme support on every page load.
 *
 * Since WordPress 3.6, themes opt in to HTML5 markup for `search-form`,
 * `comment-form`, and other surfaces via `add_theme_support( 'html5', [...] )`.
 * Modern block themes declare this; many older classic themes do not, and
 * they emit XHTML markup that is non-compliant under HTML5.
 *
 * Hooking on `after_setup_theme` at priority 999 lets the theme declare
 * its own support first; if the theme has already opted in, our call is
 * an additive no-op. If it hasn't, we layer `search-form` support on top
 * so `get_search_form()` produces a valid HTML5 form.
 */
function bootstrap(): void {
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\ensure_html5_search_support', 999 );
}

/**
 * Add `search-form` to the active theme's HTML5 support list.
 *
 * `add_theme_support()` is idempotent — calling it for an already-supported
 * feature is harmless. We deliberately scope to `search-form` only to honor
 * the plugin's stated purpose; users who want broader HTML5 support
 * (`comment-form`, `gallery`, etc.) should declare it in their theme.
 */
function ensure_html5_search_support(): void {
	add_theme_support( 'html5', [ 'search-form' ] );
}

bootstrap();
