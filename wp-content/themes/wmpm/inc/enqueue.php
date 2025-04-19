<?php  

function wmpm_scripts() {
    
    $bootstrap_css = get_template_directory_uri() . '/assets/css/bootstrap.css';
    wp_enqueue_style(
        'bootstrap-style',
        $bootstrap_css,
        array(),
        '5,3,3',
        'all'
    );
    
    wp_enqueue_style( 'wmpm_style', get_template_directory_uri().'/assets/css/wmpm_style.css', array('bootstrap-style'), filemtime(get_template_directory(  ).'/assets/css/wmpm_style.css'),'all');


    wp_enqueue_script( 'wmpm_script', get_template_directory_uri() . '/assets/js/wmpm_script.js', array(), filemtime(get_template_directory(  ).'/assets/js/wmpm_script.js'), true );
    
    wp_localize_script('wmpm_script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));


}


add_action( 'wp_enqueue_scripts', 'wmpm_scripts' );