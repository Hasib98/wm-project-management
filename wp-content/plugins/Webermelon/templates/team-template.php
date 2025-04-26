<div class="container">
  
    <div>
        <h1>Create Team</h1>
        <button class="create_team_btn">+</button>
        <div class="team_list"></div>
        <form id="team_member_form">
            <div>Add Member to Team</div>
            
            <?php
                
                $args = array(
                    'post_type' => 'team',
                    'posts_per_page' => -1, 
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $team_query = new WP_Query($args);
        
                
                if ($team_query->have_posts()) : ?>
            <select name="teams" id="teams">
                
                <?php
                       
                        while ($team_query->have_posts()) : $team_query->the_post();
                            
                            $post_id = get_the_ID();
                        ?>
                <option value="<?php echo $post_id; ?>"><?php the_title(); ?></option>
                <?php endwhile; ?>
                <?php
                   
                    wp_reset_postdata();

                else : ?>
                <p>No teams found.</p>
                <?php endif; ?>
            </select>
            <input id="add_team_member_field" type="email">
            <button id="add_team_member_btn" type="submit">Add Memmber</button>
        </form>
    </div>
</div>


