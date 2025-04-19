<?php
/**
 * @package Project_Management
 * @version 1.0.0
 */

/*
Plugin Name: Project Management
Plugin URI: http://wordpress.org/plugins/project-management/
Description: A WordPress Project Management plugin for webermelon.
Author: S. M. Hasib
Version: 1.0.0
Author URI: http://smhasib.com/
*/

if (!defined('ABSPATH')) exit; 

function wmpm_enqueue_scripts() {

    wp_enqueue_script(
        'wmpm-js',
        plugin_dir_url(__FILE__) . 'js/wmpm.js', 
        array('jquery'),
        null,
        true 
    );
    wp_localize_script('wmpm-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

}

add_action('wp_enqueue_scripts', 'wmpm_enqueue_scripts');