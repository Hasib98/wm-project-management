<?php
/*
Plugin Name: My Simple Plugin
Plugin URI: https://yourwebsite.com/
Description: A simple plugin with front page functions, CSS, and JS.
Version: 1.0
Author: Your Name
Author URI: https://yourwebsite.com/
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}



function my_html_page_shortcode() {
    ob_start();
    ?>
<div class="my-html-page">
    <h2>Welcome to My Custom Page</h2>
    <p>This is a custom HTML block rendered through a shortcode!</p>
    <div style="padding: 10px; background: #f3f3f3; border: 1px solid #ccc;">
        <strong>Fun Fact:</strong> This is displayed by a plugin shortcode.
    </div>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('my_html_page', 'my_html_page_shortcode');
/* 
// Enqueue CSS and JS
function msp_enqueue_assets() {
    wp_enqueue_style('msp-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('msp-script', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'msp_enqueue_assets');

// Frontend Functionality (example: Shortcode)
function msp_frontend_content() {
    ob_start();
    ?>
<div class="msp-box">
    <h2>Hello from My Simple Plugin!</h2>
    <button id="msp-button">Click Me!</button>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('msp_frontpage', 'msp_frontend_content');

// Create Page on Plugin Activation

function msp_create_plugin_page() {
    // Check if page already exists
    $page_title = 'My Simple Plugin Page';
    $page_check = get_page_by_title($page_title);

    if (!$page_check) {
        // Page doesn't exist, so create it
        $page_data = array(
            'post_title'    => $page_title,
            'post_content'  => '[msp_frontpage]',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );
        wp_insert_post($page_data);
    }
}
register_activation_hook(__FILE__, 'msp_create_plugin_page'); */