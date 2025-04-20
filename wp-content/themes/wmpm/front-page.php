<?php if (!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?> ">

<head>
    <meta charset=" <?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>

    <button class="create_team_btn">Create Team</button>
    <div class="list"></div>

    <?php wp_footer(); ?>

</body>

</html>


<!-- 
<form method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <?php
    //  wp_nonce_field('custom_register_action', 'custom_register_nonce');
    ?>

    <button type="submit">Register</button>
</form>

 -->