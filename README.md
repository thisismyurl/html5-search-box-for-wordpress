# HTML5 Search for WordPress

Single-file WordPress plugin that ensures HTML5 search-form markup is enabled for any active theme that hasn't declared HTML5 theme support.

[![WordPress.org](https://img.shields.io/wordpress/plugin/installs/html5-search-box-for-wordpress.svg)](https://wordpress.org/plugins/html5-search-box-for-wordpress/)
[![Rating](https://img.shields.io/wordpress/plugin/r/html5-search-box-for-wordpress.svg)](https://wordpress.org/plugins/html5-search-box-for-wordpress/#reviews)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL_v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0)

---

## Why this exists

WordPress has emitted HTML5 search-form markup since version 3.6 (2013), but only when the active theme opts in via `add_theme_support( 'html5', [ 'search-form' ] )`. Modern block themes do this by default. Many older classic themes — and some themes still in production today — never opted in, and continue to emit non-HTML5 search markup.

This plugin closes that gap without requiring you to edit `functions.php`.

## What it does

- Hooks `after_setup_theme` at priority 999 (so the theme has the first say) and adds `search-form` to the active theme's HTML5 support list.
- Idempotent — if the theme already declares HTML5 search-form support, the plugin is a harmless no-op.
- Single file. No settings, no admin UI, no enqueued assets, no markup overrides.

## What it does *not* do

- It does **not** override custom `searchform.php` template files. If your theme provides one, that template wins.
- It does **not** modify comment forms, galleries, or other HTML5 surfaces. Scope is intentionally limited to the search form to match the plugin's stated purpose.

## Requirements

- WordPress 6.4 or later.
- PHP 7.4 or later.

## Installation

1. Install through the [WordPress plugin directory](https://wordpress.org/plugins/html5-search-box-for-wordpress/) or upload the plugin folder to `wp-content/plugins/`.
2. Activate it from **Plugins** in WordPress admin.
3. Any call to `get_search_form()` in your theme will now produce HTML5 markup.

## How it works

```php
// In html5-search-for-wordpress.php
add_action( 'after_setup_theme', __NAMESPACE__ . '\\ensure_html5_search_support', 999 );

function ensure_html5_search_support(): void {
    add_theme_support( 'html5', [ 'search-form' ] );
}
```

`add_theme_support()` is idempotent — calling it for an already-supported feature is harmless. The priority of 999 lets the theme declare its own support first; we layer on top only when needed.

## Why not just override `get_search_form`?

Earlier versions of this plugin filtered `get_search_form` and returned a hard-coded HTML5 form. That approach fights themes that already provide their own markup, loses block-theme design tokens, and historically had an unescaped `get_search_query()` value injected into the input. The 16.0.0 rewrite uses the proper WordPress mechanism — declaring theme support — so themes always win, and the plugin only fills the gap when a theme hasn't opted in.

## Development

```sh
composer install
composer run lint:phpcs
```

## Changelog

See [`readme.txt`](readme.txt) for the full WordPress.org changelog.

## License

GPL v2 or later. See [LICENSE](LICENSE).

## Author

Christopher Ross — [thisismyurl.com](https://thisismyurl.com/)
