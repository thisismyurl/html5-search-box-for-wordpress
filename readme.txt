=== HTML5 Search for WordPress ===
Contributors: thisismyurl
Tags: html5, search, search-form, theme-support, markup
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 16.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds HTML5 search-form support to any active theme that never opted in, using the WordPress-native `add_theme_support()` mechanism.

== Description ==

I first published this plugin in 2009. The original version filtered `get_search_form` and returned hard-coded HTML5 markup, with `get_search_query()` injected into the input value without escaping. Search forms reflect their own input back, so the realistic risk was low — but it was still wrong, and it had been wrong since 2014. I should have caught it then. The 16.0.0 rewrite throws that approach out entirely.

Here is the right answer. WordPress has emitted HTML5 search-form markup since version 3.6 (2013), but only when the active theme calls `add_theme_support( 'html5', [ 'search-form' ] )`. Modern block themes do this by default. Plenty of older classic themes — and a surprising number of themes still in production today — never opted in, and continue to emit pre-HTML5 search markup.

This plugin closes that gap with one line. It hooks `after_setup_theme` at priority 999 so the theme has the first say, then declares `search-form` HTML5 support on the theme's behalf. `get_search_form()` produces valid HTML5 markup. Themes always win. The plugin only fills the gap.

What it does:

* Calls `add_theme_support( 'html5', [ 'search-form' ] )` on `after_setup_theme` at priority 999.
* Idempotent. If the theme has already declared HTML5 search-form support, the plugin is a harmless no-op.
* Single-file plugin. No settings, no admin UI, no enqueued assets, no markup overrides.

What it does **not** do:

* It does not override custom `searchform.php` template files. If your theme provides one, that template wins. Always.
* It does not modify comment forms, galleries, scripts, or styles. Scope is intentionally limited to the search form to match the plugin's stated purpose.
* It does not replace, filter, or wrap the search form output. The theme owns the markup.

Small, single-purpose plugin. No settings page, no admin chrome, no tracking. Activate it and it works. Deactivate it and it leaves no trace.

Originally published 2009, rewritten 2026 to use the WordPress-native `add_theme_support()` mechanism.

= About the author =

Built and maintained by Christopher Ross — 25 years working with WordPress, currently running a senior-dev consulting practice at This Is My URL. More plugins, writing, and case studies at [thisismyurl.com](https://thisismyurl.com/).

== Installation ==

1. Install through the WordPress plugin directory or upload the plugin folder to `/wp-content/plugins/`.
2. Activate it from the **Plugins** menu in WordPress admin.
3. Any call to `get_search_form()` in your theme will now produce HTML5 markup.

== Frequently Asked Questions ==

= How do I tell if my theme already declares HTML5 support? =

Open your active theme's `functions.php` and search for `add_theme_support( 'html5', ... )`. If `search-form` is in that array, your theme is already covered and this plugin will be a no-op. If it isn't, the plugin layers it in for you. You can also check at runtime with `current_theme_supports( 'html5', 'search-form' )`.

= Will this conflict with my theme's `searchform.php`? =

No. WordPress always prefers a custom `searchform.php` template over its built-in search form generator. This plugin only changes the markup that `get_search_form()` produces when no template file is present. If your theme ships a `searchform.php`, that template runs unchanged.

= Does this work with block themes? =

Block themes (Twenty Twenty-Two and later) declare full HTML5 theme support by default, so on a block theme this plugin is a no-op. It exists for older classic themes that never opted in, and for the small number of recent classic themes that still skip the declaration.

= Why limit the plugin to `search-form` instead of declaring all HTML5 features? =

Because the plugin is named "HTML5 Search." Scope discipline matters. If I added comment-form, gallery, caption, and script-style support behind the same activation, the plugin would be doing things the user didn't ask for. One concern, one declaration.

== Changelog ==

= 16.0.0 =
* Full rewrite from scratch for 2026.
* Replaced the old `get_search_form` filter override with a clean `add_theme_support( 'html5', [ 'search-form' ] )` call. Themes win by default; the plugin only fills the gap for themes that haven't opted in.
* Fixed an unescaped `get_search_query()` value previously injected into the form's input. Low realistic risk because search forms self-reflect, but still wrong, and present since 2014.
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
Full rewrite. Replaced the `get_search_form` filter override with `add_theme_support( 'html5', [ 'search-form' ] )` so themes always win. Custom `searchform.php` templates are respected. Fixes a long-standing unescaped `get_search_query()` value in the prior filter. No settings or admin UI.
