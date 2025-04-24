<?php
/**
 * Plugin Name: Webermelon Project Management
 * Description: A simple WordPress Project Management Plugin.
 * Version: 1.0.0
 * Author: S. M. Hasib
 */

if (!defined('ABSPATH')) exit;

function wmpm_enqueue_scripts() {
    if (is_page('project-manage-page')) {
        wp_enqueue_style(
            'wmpm_style',
            plugin_dir_url(__FILE__) . 'assets/css/wmpm_style.css',
            array(), // No dependencies
            filemtime(plugin_dir_path(__FILE__) . 'assets/css/wmpm_style.css')
        );

        wp_enqueue_script(
            'wmpm_script',
            plugin_dir_url(__FILE__) . 'assets/js/wmpm_script.js',
            array('jquery'),
            null,
            true
        );
        
        wp_localize_script('wmpm_script', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
}

add_action('wp_enqueue_scripts', 'wmpm_enqueue_scripts', 9999);

// Shortcode output
function my_html_page_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'homepage-copy.php';
    return ob_get_clean();
}
add_shortcode('project_manage_page', 'my_html_page_shortcode');

// Create page on plugin activation
function wmpm_create_plugin_page() {
    $page_title = 'Project Manage Page';
    $page_check = get_page_by_title($page_title);

    if (!$page_check) {
        $page_data = array(
            'post_title'    => $page_title,
            // 'post_content'  => '[project_manage_page]',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );
        $page_id = wp_insert_post($page_data);
        update_option('wmpm_redirect_to_page_id', $page_id);
    } else {
        update_option('wmpm_redirect_to_page_id', $page_check->ID);
    }
}
register_activation_hook(__FILE__, 'wmpm_create_plugin_page');

// Redirect after activation
function wmpm_redirect_after_activation() {
    if ($page_id = get_option('wmpm_redirect_to_page_id')) {
        delete_option('wmpm_redirect_to_page_id');
        wp_safe_redirect(get_permalink($page_id));
        exit;
    }
}
add_action('admin_init', 'wmpm_redirect_after_activation');

// Delete page on deactivation
function wmpm_delete_plugin_page() {
    $page = get_page_by_title('Project Manage Page');
    if ($page) {
        wp_delete_post($page->ID, true);
    }
}
register_deactivation_hook(__FILE__, 'wmpm_delete_plugin_page');




// Override the theme template for this page
function wmpm_override_template($template) {
    if (is_page('project-manage-page')) {
        return plugin_dir_path(__FILE__) . 'templates/project-manage-template.php';
    }
    return $template;
}

add_filter('template_include', 'wmpm_override_template', 99);


// Optional: remove theme styles/scripts

/* function wmpm_remove_theme_assets() {
    if (is_page('project-manage-page')) {
        // Replace with your actual theme style/script handles
        wp_dequeue_style('twentytwenty-style');
        wp_dequeue_script('twentytwenty-navigation');
    }
}
add_action('wp_enqueue_scripts', 'wmpm_remove_theme_assets', 100); */



// Enqueue only plugin styles/scripts
/* function wmpm_enqueue_scripts() {
    if (is_page('project-manage-page')) {
        wp_enqueue_style(
            'wmpm_style',
            plugin_dir_url(__FILE__) . 'assets/css/wmpm_style.css',
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'assets/css/wmpm_style.css')
        );

        wp_enqueue_script(
            'wmpm_script',
            plugin_dir_url(__FILE__) . 'assets/js/wmpm_script.js',
            array('jquery'),
            null,
            true
        );

        wp_localize_script('wmpm_script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'wmpm_enqueue_scripts'); */