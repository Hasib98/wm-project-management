<?php
if (!defined("ABSPATH")) exit;

include_once('inc/default.php');
include_once('inc/enqueue.php');
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $randomString;
}



/* function add_team()
{
    if (!isset($_POST['action']) || $_POST['action'] !== 'add_team') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    $team_name = sanitize_text_field($_POST['team_name']);


    wp_send_json_success([
        'message' => $team_name
    ]);
    wp_die();
}


add_action('wp_ajax_add_team', 'add_team');

*/




/**
 * Register custom post type 'team' for team members
 */


function team_custom_post_type()
{
    register_post_type(
        'team',
        array(
            'labels'      => array(
                'name'          => __('Team', 'textdomain'),
                'singular_name' => __('Team', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title'),
        )
    );

    register_post_type(
        'projects',
        array(
            'labels'      => array(
                'name'          => __('Projects', 'textdomain'),
                'singular_name' => __('Project', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor'),
        )
    );
}

add_action('init', 'team_custom_post_type');


/**
 * Create a new team post
 */
function create_team_post()
{

    if (!isset($_POST['action']) || $_POST['action'] !== 'create_team') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    $team_name = sanitize_text_field($_POST['team_name']);

    if (post_exists($team_name)) {
        wp_send_json_error(['message' => 'Team ' . $team_name . ' Already  Exist.']);
        wp_die();
    }
    // Post data array
    $team_post = array(
        'post_title'    => $team_name,        // The title of the post
        'post_status'   => 'publish',         // Published status
        'post_type'     => 'team',            // Your custom post type
        'post_author'   => 1,                 // Default admin user ID
    );


    // Insert the post into the database
    $post_id = wp_insert_post($team_post);

    // Check for errors
    if (is_wp_error($post_id)) {
        // Handle error
        error_log('Failed to create team post: ' . $post_id->get_error_message());
        return;
    }

    //create post meta with empty array
    update_post_meta($post_id, 'member_email_array', []);

    wp_send_json_success([
        'message' => $post_id
    ]);
    wp_die();
}

// Call this function whenever you want to create a team post

add_action('wp_ajax_create_team', 'create_team_post');


/**
 * add  email of member
 */
function add_team_member()
{

    if (!isset($_POST['action']) || $_POST['action'] !== 'add_team_member') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    $post_id = sanitize_text_field($_POST['team_id']);
    $email = sanitize_email($_POST['email']);

    $email_array = get_post_meta($post_id, 'member_email_array', true);

    if (in_array($email, $email_array)) {
        wp_send_json_error(['message' => 'User Already exists']);
        wp_die();
    }

    $email_array[] = $email; // Step 3: Push new email

    // Step 4: Save back
    update_post_meta($post_id, 'member_email_array', $email_array);


    wp_send_json_success(['message' => $email . ' added']);
    wp_die();
}

// Call this function whenever you want to create a team post

add_action('wp_ajax_add_team_member', 'add_team_member');






/* ====================create project =========================== */


/**
 * Create a new project post
 */


function create_project_post()
{

    if (!isset($_POST['action']) || $_POST['action'] !== 'create_project') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }


    $project_name = sanitize_text_field($_POST['project_name']);


    if (post_exists($project_name)) {
        wp_send_json_error(['message' => 'Team ' . $project_name . ' ALready  Exist.']);
        wp_die();
    }
    // Post data array
    $project_post = array(
        'post_title'    => $project_name,        // The title of the post
        'post_content'  => '',
        'post_status'   => 'publish',         // Published status
        'post_type'     => 'projects',            // Your custom post type
        'post_author'   => 1,                 // Default admin user ID
    );


    // Insert the post into the database
    $post_id = wp_insert_post($project_post);

    // Check for errors
    if (is_wp_error($post_id)) {
        // Handle error
        error_log('Failed to create project post: ' . $post_id->get_error_message());
        return;
    }

    //create post meta with empty array
    // update_post_meta($post_id, 'member_array', []);
    // update_post_meta($post_id, 'details', '');
    // update_post_meta($post_id, 'due_date', '');
    // update_post_meta($post_id, 'priority_array', ['low','medium','high']);
    // update_post_meta($post_id, 'status', ['started','In progress','Done']);
    update_post_meta($post_id, 'member_array', []);
    wp_send_json_success([
        'message' => $post_id
    ]);
    wp_die();
}

// Call this function whenever you want to create a project post

add_action('wp_ajax_create_project', 'create_project_post');



function get_team_member()
{

    if (!isset($_POST['action']) || $_POST['action'] !== 'get_team_member') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }


    $post_id = sanitize_text_field($_POST['team_id']);

    $email_array = get_post_meta($post_id, 'member_email_array', true);

    

    wp_send_json_success([
        'message' => $email_array
    ]);
    wp_die();
}

// Call this function whenever you want to create a project post

add_action('wp_ajax_get_team_member', 'get_team_member');





function update_project()
{

    if (!isset($_POST['action']) || $_POST['action'] !== 'update_project') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }


    $post_id = intval(sanitize_text_field($_POST['project_id']));
    $project_details = sanitize_textarea_field($_POST['projectd_details']);
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    // $selected_team = $_POST['selected_team'];
    $member_email = $_POST['member'];


    $email_array = get_post_meta($post_id, 'member_array', true);

    if (in_array($member_email, $email_array)) {
        wp_send_json_error(['message' => 'Member Already exists']);
        wp_die();
    }
    $email_array[] = $member_email; // Step 3: Push new email

    // Step 4: Save back
    

/*     $email_array = get_post_meta($post_id, 'member_array', true);

    $email_array = array_push($email_array,$member_email);  */
   
     update_post_meta($post_id, 'details', $project_details);
     update_post_meta($post_id, 'due_date', $due_date);
     update_post_meta($post_id, 'priority', $priority);
     update_post_meta($post_id, 'status', $status);
     update_post_meta($post_id, 'member_array', $email_array);

    wp_send_json_success([
        'message' => $post_id
    ]);
    wp_die();
}

add_action('wp_ajax_update_project', 'update_project');
