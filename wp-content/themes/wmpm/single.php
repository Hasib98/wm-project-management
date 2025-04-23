<?php if (!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?> ">

<head>
    <meta charset=" <?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            $post_id = get_the_ID();
            $post_name = get_the_title();
            $details = get_post_meta($post_id, 'details', true);
            $priority = get_post_meta($post_id, 'priority', true);
            $due_date = get_post_meta($post_id, 'due_date', true);
            $status = get_post_meta($post_id, 'status', true);
            $member_array = get_post_meta($post_id, 'member_array', true);
        endwhile;
    endif;
    ?>
    <section>
        <div class="container">
            <h1><?php echo $post_id ; ?></h1>
            <h1><?php echo $post_name ; ?></h1>
            <h1><?php echo $details ; ?></h1>
            <h1><?php echo $priority ; ?></h1>
            <h1><?php echo $status ; ?></h1>
            <h1><?php echo $due_date ; ?></h1>            

            <?php 
            foreach ($member_array as $email) {
                echo '<li><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></li>';
            }
            ?>


        </div>
    </section>

<?php wp_footer(); ?>
</body>

</html>