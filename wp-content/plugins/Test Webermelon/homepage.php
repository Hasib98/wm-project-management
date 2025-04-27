
<?php 
    $user = wp_get_current_user();
    if ( in_array( 'administrator', $user->roles ) || in_array( 'editor', $user->roles ) ) {
        include plugin_dir_path( __FILE__ ) . 'templates/part-create_team.php';
        // include plugin_dir_path( __FILE__ ) . 'templates/part-create_project.php';
    }
   /*  else {
        echo '<h1>You do not have permission to view this page.</h1>';
    } */
    // include plugin_dir_path( __FILE__ ) . 'templates/part-project_list.php';
?>




