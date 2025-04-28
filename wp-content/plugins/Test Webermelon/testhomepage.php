<?php if (!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?> ">

<head>
    <meta charset=" <?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>
    <div class="container">
        <!-- create team -->
        <div>
            <button class="create_team_btn">Create Team</button>
            <div class="team_list"></div>

            <br>
            <br>
            <br>
            <form id="team_member_form">
                <input id="add_team_member_field" type="email">
                    <?php
                    // Custom query to get team posts
                    $args = array(
                        'post_type' => 'team',
                        'posts_per_page' => -1, // Get all posts. You can limit this if needed
                        'post_status' => 'publish',
                        'orderby' => 'title',
                        'order' => 'ASC'
                    );

                    $team_query = new WP_Query($args);

                    // Check if we have posts
                    if ($team_query->have_posts()) : ?>
                    <select name="teams" id="teams">
                        <?php
                            // Start the loop
                            while ($team_query->have_posts()) : $team_query->the_post();
                                // Get the post ID
                                $post_id = get_the_ID();
                            ?>
                        <option value="<?php echo $post_id; ?>"><?php the_title(); ?></option>
                        <?php endwhile; ?>
                        <?php
                        // Reset post data
                        wp_reset_postdata();

                    else : ?>
                        <p>No teams found.</p>
                        <?php endif; ?>
                    </select>
                <button id="add_team_member_btn" type="submit">Add Memmber</button>
            </form>
        </div>
        <hr class="solid">

        <!-- create project -->
        <div>
            <button class="create_project_btn">Create Project</button>
            <div class="project_list"></div>
            <br>
            <br>
            <br>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="container">
        <form id="project_details_form">
            <!-- <input type="text"> -->
            <?php
                // Custom query to get team posts
                $args = array(
                    'post_type' => 'projects',
                    'posts_per_page' => -1, // Get all posts. You can limit this if needed
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $project_query = new WP_Query($args);

                // Check if we have posts
                if ($project_query->have_posts()) : ?>
            <select name="project" id="project">
                <?php
                        // Start the loop
                        while ($project_query->have_posts()) : $project_query->the_post();
                            // Get the post ID
                            $post_id = get_the_ID();
                        ?>
                <option value="<?php echo $post_id; ?>"><?php the_title(); ?></option>
                <?php endwhile; ?>
                <?php
                    // Reset post data
                    wp_reset_postdata();

                else : ?>
                <p>No teams found.</p>
                <?php endif; ?>
            </select>
            <textarea name="projectd_details" id="projectd_details"></textarea>
            <input type="date" name="due_date" id="due_date">
            <select name="priority" id="priority">
                <option value="low">low</option>
                <option value="medium">medium</option>
                <option value="high">high</option>
            </select>
            <select name="status" id="status">
                <option value="started">started</option>
                <option value="In progress">In progress</option>
                <option value="Done">Done</option>
            </select>
            <?php
                // Custom query to get team posts
                $args = array(
                    'post_type' => 'team',
                    'posts_per_page' => -1, // Get all posts. You can limit this if needed
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $team_query = new WP_Query($args);

                // Check if we have posts
                if ($team_query->have_posts()) : ?>
            <select name="teams" id="selected_team">
                <?php
                        // Start the loop
                        while ($team_query->have_posts()) : $team_query->the_post();
                            // Get the post ID
                            $post_id = get_the_ID();
                        ?>
                <option value="<?php echo $post_id; ?>"><?php the_title(); ?></option>
                <?php endwhile; ?>
                <?php
                    // Reset post data
                    wp_reset_postdata();

                else : ?>
                <p>No teams found.</p>
                <?php endif; ?>
            </select>
            <select name="mebmber" id="member">
                <!-- <option value="test@test.com">test@test.com</option>
                <option value="alpha@beta.com">alpha@beta.com</option>
                <option value="gama@nautt.com">gama@nautt.com</option> -->
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="container project_list">
    <ul>
    <?php
                // Custom query to get team posts
                $args = array(
                    'post_type' => 'projects',
                    'posts_per_page' => -1, // Get all posts. You can limit this if needed
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $project_query = new WP_Query($args);

                // Check if we have posts
                if ($project_query->have_posts()) : 
    ?>
    <?php
                        // Start the loop
                        while ($project_query->have_posts()) : $project_query->the_post();
                            // Get the post ID
                            $post_id = get_the_ID();
                            $post_link =  get_post_permalink();
    ?>
                <li><a href="<?php echo $post_link; ?>"><?php the_title(); ?></a></li> 
                <?php endwhile; ?>
                <?php
                    // Reset post data
                    wp_reset_postdata();

                else : ?>
                <p>No teams found.</p>
                <?php endif; ?>
                </ul>
    </div>

    <?php wp_footer(); ?>

</body>

</html>