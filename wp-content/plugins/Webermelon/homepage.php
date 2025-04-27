<header>
    <div class="toggle_left_bar_burger_button_container">
        <img src="<?php echo plugin_dir_url(__FILE__).'/assets/images/burger-menu-left-svgrepo-com.svg'; ?>" alt="Toggle Icon">
    </div>
    <div class="logo_container">
        <a href="<?php echo esc_url(home_url('project-manage-page')); ?>" class="logo">
            <img src="<?php echo plugin_dir_url(__FILE__).'/assets/images/logo.png'; ?>" alt="Logo">
        </a>
    </div>
</header>


<div class="sidebar open">
    <div class="team">
        <div class="team_name_container">
            <h3>Teams</h3>
            <button class="toggle_team_button">+</button>
        </div>
        <form class="create_team_form">
            <input name="team_name" type="text" placeholder="Create a new team" class="create_team_input" required> 
                
        </form>

        <ul class="team_list">
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
                
                    <?php
                        // Start the loop
                        while ($team_query->have_posts()) : $team_query->the_post();
                            // Get the post ID
                            $post_id = get_the_ID();
                        ?>
                    <li class="single_team_list" value="<?php echo $post_id; ?>"><?php the_title(); ?></></li>
                    <?php endwhile; ?>
                    <?php
                    // Reset post data
                    wp_reset_postdata();

                else : ?>
                    <p>No teams found.</p>
                    <?php endif; ?>
        </ul>
    </div>
   
</div>


<div class="team_modal open">
    <div class="team_modal_content">
        <span class="close_team_modal">&times;</span>
        <h2><span id="team_name"></span> Members</h2>
        <form id="invite_member_form">
            <input name="recipient_email" type="email" placeholder="Add Team Member by Email" required>
        </form>

     </div>
</div>




.