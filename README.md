# HTML5 Search for WordPress

Single-file WordPress plugin that adds HTML5 search-form support to any active theme that never opted in, using the WordPress-native `add_theme_support()` mechanism.

[![WordPress.org](https://img.shields.io/wordpress/plugin/installs/html5-search-box-for-wordpress.svg)](https://wordpress.org/plugins/html5-search-box-for-wordpress/)
[![Rating](https://img.shields.io/wordpress/plugin/r/html5-search-box-for-wordpress.svg)](https://wordpress.org/plugins/html5-search-box-for-wordpress/#reviews)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL_v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0)

---

## Why this exists

I first published this plugin in 2009. The original version filtered `get_search_form` and returned hard-coded HTML5 markup, with `get_search_query()` injected into the input value without escaping. Search forms reflect their own input back, so the realistic risk was low — but it was still wrong, and it had been wrong since 2014. I should have caught it then. The 16.0.0 rewrite throws that approach out and uses the right WordPress mechanism instead.

WordPress has emitted HTML5 search-form markup since version 3.6 (2013), but only when the active theme calls `add_theme_support( 'html5', [ 'search-form' ] )`. Modern block themes do this by default. Plenty of older classic themes never opted in. This plugin closes that gap in one line, without you having to edit `functions.php`.

## What it does

- Hooks `after_setup_theme` at priority 999 (so the theme has the first say) and declares `search-form` HTML5 support on the theme's behalf.
- Idempotent. If the theme already declares HTML5 search-form support, the plugin is a harmless no-op.
- Single file. No settings, no admin UI, no enqueued assets, no markup overrides.

## What it does *not* do

- It does **not** override custom `searchform.php` template files. If your theme provides one, that template wins.
- It does **not** modify comment forms, galleries, or other HTML5 surfaces. Scope is intentionally limited to the search form to match the plugin's name.
- It does **not** filter or wrap search form output. The theme owns the markup.

## Requirements

- WordPress 6.4 or later.
- PHP 7.4 or later.

## Installation

1. Install through the [WordPress plugin directory](https://wordpress.org/plugins/html5-search-box-for-wordpress/) or upload the plugin folder to `wp-content/plugins/`.
2. Activate it from **Plugins** in WordPress admin.
3. Any call to `get_search_form()` in your theme will now produce HTML5 markup.

## How it works

The whole plugin is essentially this:

```php
add_action( 'after_setup_theme', __NAMESPACE__ . '\\ensure_html5_search_support', 999 );

function ensure_html5_search_support(): void {
    add_theme_support( 'html5', [ 'search-form' ] );
}
```

`add_theme_support()` is idempotent — calling it for an already-supported feature is harmless. Priority 999 lets the theme declare its own support first; the plugin only layers on top when the theme has stayed silent.

## Why not just override `get_search_form`?

That is what the original 2009 version did, and it is the wrong approach. Filtering `get_search_form` to return hard-coded markup fights themes that already provide their own form, ignores block-theme design tokens, and means every consumer of the filter has to be rewritten the day a better answer ships. The original also injected `get_search_query()` into the input value without escaping — low realistic risk because search forms reflect their own input back, but still a real bug that lived in the code from 2014 until this rewrite.

`add_theme_support( 'html5', [ 'search-form' ] )` is the WordPress-native answer. The theme always wins. The plugin only fills the gap for themes that haven't opted in. Custom `searchform.php` templates are respected automatically because the change happens before WordPress decides what to render.

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
