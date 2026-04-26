# HTML5 Search for WordPress

Replaces the default WordPress search form with a clean HTML5 `<input type="search">` form, including the `placeholder` attribute, `autocomplete` controls, and a stylesheet hook for theme overrides.

[![WordPress.org](https://img.shields.io/wordpress/plugin/installs/html5-search-box-for-wordpress.svg)](https://wordpress.org/plugins/html5-search-box-for-wordpress/)

## Why this exists

WordPress core ships a search form built around the older `<input type="text">` markup. This plugin replaces the markup at the `get_search_form()` filter level so any theme calling `get_search_form()` automatically benefits — without forcing theme authors to override their template.

Improvements over the core form:

- Uses semantic `<input type="search">` (mobile keyboards show search-specific UI).
- Adds `placeholder` text for visual cue.
- Sets `autocomplete="off"` to prevent the browser from offering stale terms.
- CSS hook (`thisismyurl-html5-search`) for theme overrides.

## Features

- Drop-in `get_search_form()` replacement.
- HTML5-semantic markup.
- Stylesheet included; can be dequeued or overridden.
- Multilingual support (English, German, French).
- Zero configuration — activate and use.

## Requirements

- WordPress 3.2.0 or later (tested through 4.1; works on modern WP).
- PHP 5.3+.
- A theme that calls `get_search_form()` (most do).

## Installation

1. Upload the plugin folder to `wp-content/plugins/` or install via the WordPress.org directory.
2. Activate from **Plugins** in WordPress admin.
3. Any template calling `get_search_form()` now renders the HTML5 form.

## Status

Maintenance mode.

For active development of WordPress + SEO tooling, see [thisismyurl.com](https://thisismyurl.com/).

## License

GPL v2 or later.

## Contributors

- Christopher Ross — co-maintainer
- Joel Arseneault (jfarsen) — original author
- tinkerpriest — contributor

