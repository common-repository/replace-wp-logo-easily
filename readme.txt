=== Replace WP Logo Easily ===
Contributors: Ardetahost
Tags: logo wp, change logo, wp login, custom logo
Requires at least: 5.0
Tested up to: 6.6.1
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easily replace the default WordPress login logo with your custom image. Simple to use—just install, upload your logo, and you're done.
== Description ==

Easily replace the default WordPress login logo with your custom image. Simple to use—just install, upload your logo, and you're done.

== Screenshots ==

1. screenshot-1.png

== Installation ==

1. Upload `replace-wp-logo-easily` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to **Admin Dashboard Menu** > **Replace WP Logo Easily** to upload your custom logo.
4. Upload your logo image and save the changes.
5. Visit your WordPress login page to see your new logo in action.

== Frequently Asked Questions ==

= How do I replace the WordPress login logo? =

Simply activate the plugin and go to **Admin Dashboard Menu** > **Replace WP Logo Easily** to upload your custom logo. Once uploaded and saved, your new logo will appear on the WordPress login page.

= What is the recommended logo size? =

For the best results, use a logo with dimensions of 320 pixels wide by 120 pixels tall. This size ensures that your logo displays clearly and proportionately on the login page.


== Changelog ==

= 1.0.2 - September 28, 2024 =
* Public Release: The plugin is now available to the public through the WordPress repository.
* Added Screenshots: Screenshots have been included to provide a visual representation of the plugin's features and functionality.
* Script Optimization: Unnecessary or redundant scripts have been removed or optimized to improve the plugin's performance.

= 1.0.1 - September 27, 2024 =
* Adjusted usage of `wp_enqueue_script`, `wp_enqueue_style`, `wp_add_inline_script`, and `wp_add_inline_style` to comply with WordPress standards.
* Moved the media uploader functionality to an external JavaScript file (`js/rwle-custom.js`) to maintain modularity.
* Added an external CSS file (`css/login-custom.css`) to customize the login page appearance.
* Implemented `wp_nonce_field` for improved security on plugin settings.
* Applied proper sanitization (`sanitize_text_field` and `wp_unslash`) for handling user input.

= 1.0.0 - September 8, 2024 =
* Initial release and submission to WordPress repository
