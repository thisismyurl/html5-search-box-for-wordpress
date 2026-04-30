=== HTML5 Search for WordPress ===
Contributors: thisismyurl
Tags: html5, search, search-form, theme-support, markup
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 16.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Ensures HTML5 search-form markup is enabled for any active theme that has not declared HTML5 theme support.

== Description ==

WordPress has emitted HTML5 search-form markup since version 3.6 (2013), but only when the active theme calls `add_theme_support( 'html5', [ 'search-form' ] )`. Modern block themes do this by default. Many older classic themes — and some themes still in production today — never opted in, and continue to emit non-HTML5 search markup.

This plugin closes that gap. It hooks `after_setup_theme` at priority 999 (so the theme has the first say) and adds `search-form` to the active theme's HTML5 support list. The result: `get_search_form()` produces a valid HTML5 search form on any theme, without you having to edit `functions.php`.

What it does:

* Adds `search-form` to the theme's `html5` support list on every page load.
* Idempotent — if the theme has already declared HTML5 search-form support, this plugin is a harmless no-op.
* Single-file plugin. No settings, no admin UI, no enqueued assets, no markup overrides.

What it does **not** do:

* It does not override custom `searchform.php` template files. If your theme provides one, that template wins.
* It does not modify comment forms, galleries, or other HTML5 surfaces. Scope is intentionally limited to the search form to match the plugin's stated purpose.

== Installation ==

1. Install through the WordPress plugin directory or upload the plugin folder to `/wp-content/plugins/`.
2. Activate it from the **Plugins** menu in WordPress admin.
3. Any call to `get_search_form()` in your theme will now produce HTML5 markup.

== Frequently Asked Questions ==

= How do I know if my theme already supports HTML5 search forms? =

In your active theme's `functions.php`, look for `add_theme_support( 'html5', ... )` with `'search-form'` in the array. If it's there, your theme already supports HTML5 search forms and this plugin will simply be a no-op. If it isn't, this plugin layers it in for you.

= Does this work with block themes? =

Block themes (Twenty Twenty-Two and later) declare full HTML5 theme support by default, so this plugin is a no-op on them. It exists primarily for older classic themes that never opted in.

= My theme provides a `searchform.php` file. Will this plugin override it? =

No. WordPress prefers custom `searchform.php` templates over its built-in search form generator. This plugin only affects themes that rely on `get_search_form()` to generate the markup.

== Changelog ==

= 16.0.0 =
* Full rewrite from scratch for 2026.
* Replaced the old `get_search_form` filter override with a clean `add_theme_support( 'html5', [ 'search-form' ] )` call. Themes win by default; the plugin only fills the gap for themes that haven't opted in.
* Fixed unescaped `get_search_query()` value previously injected into the form's `value` attribute.
* Modern PHP (`declare(strict_types=1)`, namespaces, `Requires PHP: 7.4`).
* Removed the bundled "common framework," donate prompt, and admin settings page.
* Single-file plugin, WPCS-clean.

= 15.01 =
* Added OOP class structure.
* Migrated to common plugin structure, tested for WordPress 4.1.

= 1.0.0 =
* Initial release, based on the search form pattern from Bavota San.

== Upgrade Notice ==

= 16.0.0 =
Full rewrite. The plugin now uses `add_theme_support()` rather than a custom `get_search_form` filter, deferring to your theme by default. Custom `searchform.php` templates and theme-declared HTML5 support are now respected. No settings or admin UI.
