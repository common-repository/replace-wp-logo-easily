<?php
/*
Plugin Name: Replace WP Logo Easily
Description: Easily replace the default WordPress login logo with your custom image. Simple to use—just install, upload your logo, and you're done.
Version: 1.0.2
Author: Ardetahost Media Group
Author URI: https://ardetahost.com/
Plugin URI: https://ardetahost.com/replace-wp-logo-easily/
Text Domain: replace-wp-logo-easily
Requires at least: 6.0
Requires PHP: 8.0
License: GPLv2 or later
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Function to add menu in admin dashboard
function rwle_add_replace_logo_menu() {
    add_menu_page(
        'Replace Logo Settings',
        'Replace WP Logo',
        'manage_options',
        'replace-wp-logo',
        'rwle_display_settings_page',
        'dashicons-format-image',
        100
    );
}
add_action('admin_menu', 'rwle_add_replace_logo_menu');

// Function to display settings page
function rwle_display_settings_page() {
    // Save settings if form is submitted
    if (isset($_POST['submit']) && check_admin_referer('rwle_replace_wp_logo_nonce')) {
        update_option('rwle_logo_active', isset($_POST['activate_logo']) ? '1' : '0');
        if (isset($_POST['logo_url'])) {
            update_option('rwle_logo_url', sanitize_text_field(wp_unslash($_POST['logo_url'])));
        }
        echo '<div class="updated"><p>Settings saved successfully.</p></div>';
    }

    // Get current settings
    $active = get_option('rwle_logo_active', '0');
    $logo_url = get_option('rwle_logo_url', '');

    // Display settings form
    ?>
    <div class="wrap">
        <h1>Replace WordPress Logo Settings</h1>
        <?php
        // Display the currently used logo
        if ($active == '1' && !empty($logo_url)) {
            echo '<div style="margin-bottom: 20px;">';
            echo '<h2>Currently Used Logo:</h2>';
            echo '<img src="' . esc_url($logo_url) . '" alt="Current Logo" style="max-width: 320px; max-height: 120px;">';
            echo '</div>';
        }
        ?>
        <form method="post" action="">
            <?php wp_nonce_field('rwle_replace_wp_logo_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Activate Custom Logo</th>
                    <td>
                        <label for="activate_logo">
                            <input type="checkbox" name="activate_logo" id="activate_logo" value="1" <?php checked('1', $active); ?>>
                            Activate
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Logo URL</th>
                    <td>
                        <input type="text" name="logo_url" id="logo_url" value="<?php echo esc_attr($logo_url); ?>" class="regular-text">
                        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Choose Image">
                        <p class="description">Recommended logo size: 320px x 120px</p>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </p>
        </form>
    </div>
    <?php
}

// Function to enqueue media uploader and custom script
function rwle_enqueue_media_uploader($hook_suffix) {
    if ($hook_suffix === 'toplevel_page_replace-wp-logo') { // Restrict to settings page
        wp_enqueue_media();
        wp_enqueue_script('rwle-custom-js', plugin_dir_url(__FILE__) . 'js/rwle-custom.js', array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'js/rwle-custom.js'), true);
    }
}
add_action('admin_enqueue_scripts', 'rwle_enqueue_media_uploader');

// Function to replace login logo using inline style
function rwle_replace_login_logo() {
    if (get_option('rwle_logo_active') == '1') {
        $logo_url = get_option('rwle_logo_url');
        if (!empty($logo_url)) {
            $custom_css = "
                #login h1 a {
                    background-image: url('" . esc_url($logo_url) . "') !important;
                    background-size: contain !important;
                    width: 320px !important;
                    height: 120px !important;
                    background-position: center center !important;
                    margin: 0 auto !important;
                }
            ";
            wp_add_inline_style('login', $custom_css);
        }
    }
}
add_action('login_enqueue_scripts', 'rwle_replace_login_logo');

// Enqueue the login page styles if necessary
function rwle_enqueue_custom_login_styles() {
    if (get_option('rwle_logo_active') == '1') {
        wp_enqueue_style('rwle-login-style', plugin_dir_url(__FILE__) . 'css/login-custom.css', array(), filemtime(plugin_dir_path(__FILE__) . 'css/login-custom.css'));
    }
}
add_action('login_enqueue_scripts', 'rwle_enqueue_custom_login_styles');

// Function to modify login logo URL
function rwle_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'rwle_login_logo_url');

// Function to modify login logo title
function rwle_login_logo_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'rwle_login_logo_title');
