# HTML5 Search for WordPress

[![WordPress](https://img.shields.io/badge/WordPress-6.4%2B-blue)](https://wordpress.org/plugins/html5-search-box-for-wordpress/) [![License](https://img.shields.io/badge/License-GPL--2.0-blue)](LICENSE)

Single-file WordPress plugin that adds HTML5 search-form support to any active theme that never opted in, using the WordPress-native `add_theme_support()` mechanism.

## Why this exists

I first published this plugin in 2009. The original version filtered `get_search_form` and returned hard-coded HTML5 markup, with `get_search_query()` injected into the input value without escaping. Search forms reflect their own input back, so the realistic risk was low — but it was still wrong, and it had been wrong since 2014. I should have caught it then. The 16.0.0 rewrite throws that approach out and uses the right WordPress mechanism instead.

WordPress has emitted HTML5 search-form markup since version 3.6 (2013), but only when the active theme calls `add_theme_support( 'html5', [ 'search-form' ] )`. Modern block themes do this by default. Plenty of older classic themes never opted in. This plugin closes that gap in one line, without you having to edit `functions.php`.

## What it does

- Hooks `after_setup_theme` at priority 999 (so the theme has the first say) and declares `search-form` HTML5 support on the theme's behalf.
- Idempotent. If the theme already declares HTML5 search-form support, the plugin is a harmless no-op.
- Single file. No settings, no admin UI, no enqueued assets, no markup overrides.

## What it doesn't do

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

See [releases](../../releases) or [readme.txt](readme.txt).

---

## Support and donations

I build these tools because WordPress sites in the wild keep hitting the same problems, and a small, focused plugin is usually the right fix. They're free to use, with no tracking and no ads.

If one of them saves you time, here are the genuine ways to help:

- **Sponsor the work.** [GitHub Sponsors](https://github.com/sponsors/thisismyurl) is the simplest way, and the Sponsor button at the top of this repo lists it alongside Bitcoin, Dogecoin, PayPal, and Interac e-transfer. Any amount helps, and none of it is expected.
- **Contribute code or ideas.** A pull request, a bug report, or a tested edge case is worth as much as a donation. See [CONTRIBUTING.md](CONTRIBUTING.md) to get started.
- **Share it.** A note on [WordPress.org](https://profiles.wordpress.org/thisismyurl/), [GitHub](https://github.com/thisismyurl), or [LinkedIn](https://linkedin.com/in/thisismyurl) helps other people find work that might save them the same afternoon.

### Report issues and questions

- **Found a bug or want a feature?** Open an issue on the [Issues](../../issues) tab. Include your WordPress and PHP versions and the steps to reproduce it.
- **Have a question?** Start a thread on the [Discussions](../../discussions) tab.

### Contributing code

Code contributions are welcome. The short version:

1. Fork the repository and clone your fork.
2. Create a branch with a clear name, like `feature/short-descriptive-name`.
3. Make your change and test it against the edge cases.
4. Run the coding-standards check before you open the pull request.
5. Open a pull request that explains what changed and why.

The full workflow and standards live in [CONTRIBUTING.md](CONTRIBUTING.md). Contributing is never required, but it is always appreciated.

## About This Is My URL

This plugin is built and maintained by [This Is My URL](https://thisismyurl.com/), the WordPress development and technical SEO practice of Christopher Ross. I help teams build WordPress sites that stay secure, fast, and maintainable, and I write small, focused plugins like this one for the problems those sites keep running into.

### My background

- On the web since 1996, and in WordPress since 2007
- WordPress.org plugin developer with 19 plugins published since 2009
- Technical SEO practitioner focused on performance, security, and search visibility
- Lead instructor and curriculum architect at the M.L. Campbell Training Center, the Sherwin-Williams® international training facility for its industrial wood division

### Ways to connect

- **Website:** [thisismyurl.com](https://thisismyurl.com/)
- **WordPress.org:** [profiles.wordpress.org/thisismyurl](https://profiles.wordpress.org/thisismyurl/)
- **GitHub:** [github.com/thisismyurl](https://github.com/thisismyurl)
- **LinkedIn:** [linkedin.com/in/thisismyurl](https://linkedin.com/in/thisismyurl)

## Contributors

- **Christopher Ross** ([@thisismyurl](https://github.com/thisismyurl)) — author and maintainer
- Thanks to everyone who has reported issues, tested edge cases, and contributed code

## License

GPL-2.0-or-later — see [LICENSE](LICENSE) or [gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html).

---
*This project follows the [10 Core Pillars](PILLARS.md). Support quality work [here](https://github.com/sponsors/thisismyurl).*
