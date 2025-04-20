<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['custom_register_nonce']) && wp_verify_nonce($_POST['custom_register_nonce'], 'custom_register_action')) {

    $username = sanitize_user($_POST['username']);
    $password = $_POST['password']; // You might want to validate password strength
    $email = sanitize_email($_POST['email']);

    if (username_exists($username) || email_exists($email)) {
        echo 'Username or email already exists.';
    } else {
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            echo 'Error: ' . $user_id->get_error_message();
        } else {
            echo 'User registered successfully!';
            // You can log them in or redirect here
        }
    }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = sanitize_email($_POST['email']);

    $username = strstr($email, '@', true);
    $password = mt_rand(10000, 99999);

    if (username_exists($username) || email_exists($email)) {
        echo 'Username or email already exists.';
        return;
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        echo 'Error: ' . $user_id->get_error_message();
        return;
    }


    echo 'User registered successfully!';


    $message = "Hello,\n\n";
    $message .= "Your account has been created successfully.\n\n";
    $message .= "Here are your login details:\n";
    $message .= "User ID: $user_id\n";
    $message .= "Username: $username\n";
    $message .= "Password: $password\n\n";
    $message .= "Please store this information securely.\n\n";
    $message .= "Best regards,\n";
    $message .= "Your Website Team";


    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($email, "Invitation in the team", $message, $headers, "");
}



function send_invite()
{
    if (!isset($_POST['action']) || $_POST['action'] !== 'send_invite') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    $email = sanitize_email($_POST['email']);


    if (email_exists($email)) {
        echo 'user already exists.';
        return;
    }
    $token = generateRandomString();

    $site_url = get_site_url();

    $message = "Hello,\n\n";
    $message .= "You are invited to join Webermelon  team,\n\n";
    $message .= "please Click the link below:\n";
    $message .= "Link: $site_url./invitation?token=$token\n";
    $message .= "Webermelon";

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($email, "Invitation in the team", $message, "", "");



    wp_send_json_success([
        'message' => "Link: $site_url./invitation?token=$token\n"
    ]);
    wp_die();
}


add_action('wp_ajax_send_invite', 'send_invite');



function handle_invitation_request()
{
    // Check if we're on the invitation page
    $current_url = $_SERVER['REQUEST_URI'];

    if (strpos($current_url, '/invitation') !== false) {
        // Get the token parameter
        $token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';

        if ($token) {

            echo "Token received: " . $token;
        }
    }
}
add_action('template_redirect', 'handle_invitation_request');







if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = sanitize_email($_POST['email']);

    $username = strstr($email, '@', true);
    $password = mt_rand(10000, 99999);

    if (username_exists($username) || email_exists($email)) {
        echo 'Username or email already exists.';
        return;
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        echo 'Error: ' . $user_id->get_error_message();
        return;
    }


    echo 'User registered successfully!';


    $message = "Hello,\n\n";
    $message .= "Your account has been created successfully.\n\n";
    $message .= "Here are your login details:\n";
    $message .= "User ID: $user_id\n";
    $message .= "Username: $username\n";
    $message .= "Password: $password\n\n";
    $message .= "Please store this information securely.\n\n";
    $message .= "Best regards,\n";
    $message .= "Your Website Team";


    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($email, "Invitation in the team", $message, $headers, "");
}
