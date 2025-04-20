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







function add_team()
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

/**
 * Register custom post type 'team' for team members
 */
function register_team_post_type()
{
    $labels = array(
        'name'               => 'Team Members',
        'singular_name'      => 'Team Member',
        'menu_name'          => 'Team',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Team Member',
        'edit_item'          => 'Edit Team Member',
        'new_item'           => 'New Team Member',
        'view_item'          => 'View Team Member',
        'search_items'       => 'Search Team Members',
        'not_found'          => 'No team members found',
        'not_found_in_trash' => 'No team members found in Trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'team'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => array('title'), // Only title support, no editor
    );

    register_post_type('team', $args);
}
add_action('init', 'register_team_post_type');

/**
 * Add meta box for team member email
 */
function add_team_meta_boxes()
{
    add_meta_box(
        'team_email_meta_box',
        'Team Member Email',
        'display_team_email_meta_box',
        'team',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_team_meta_boxes');

/**
 * Display team member email meta box
 */


function display_team_email_meta_box($post)
{
    // Add nonce for security
    wp_nonce_field('team_email_meta_box', 'team_email_meta_box_nonce');

    // Get the saved email value if exists
    $email = get_post_meta($post->ID, '_team_member_email', true);

    // Output the email field
?>
    <p>
        <label for="team_member_email">Email Address:</label>
        <input type="email" id="team_member_email" name="team_member_email" value="<?php echo esc_attr($email); ?>" size="40" />
    </p>
<?php
}


/**
 * Save the team member email meta data
 */
function save_team_meta_data($post_id)
{
    // Check if nonce is set
    if (!isset($_POST['team_email_meta_box_nonce'])) {
        return;
    }

    // Verify nonce
    if (!wp_verify_nonce($_POST['team_email_meta_box_nonce'], 'team_email_meta_box')) {
        return;
    }

    // Check if auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permission
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the email if set
    if (isset($_POST['team_member_email'])) {
        $email = sanitize_email($_POST['team_member_email']);
        update_post_meta($post_id, '_team_member_email', $email);
    }
}
add_action('save_post_team', 'save_team_meta_data');
