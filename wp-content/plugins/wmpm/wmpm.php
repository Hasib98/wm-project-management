<?php
/**
 * @package wmpm
 * @version 1.0.0
 */
/*
Plugin Name: Webermelon Project Management
Plugin URI: http://wordpress.org/plugins/wmpm
Description: A simple WordPress Project Management Plugin.
Author: S. M. Hasib
Version: 1.0.0
Author URI: http://smhasib.com/
*/
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function wmpm_enqueue_scripts() {
    wp_enqueue_style(
        'wmpm_style', 
        plugin_dir_url(__FILE__)  . 'css/wmpm_style.css', array(), 
        filemtime(plugin_dir_path(__FILE__). 'css/wmpm_style.css'),
         'all');


    wp_enqueue_script(
        'wmpm_script',
        plugin_dir_url(__FILE__) . 'js/wmpm_script.js', 
        array('jquery'), 
        null, 
        true 
    );

    wp_localize_script('wmpm_script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

}

add_action('wp_enqueue_scripts', 'wmpm_enqueue_scripts');

