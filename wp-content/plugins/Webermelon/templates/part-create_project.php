<?php
/**
 * Template Part: Create project Form
 * Displayed only for administrators and editors
 */
?>


<div class="container">
    <div>
        <h1>Create Project</h1>
        <button class="create_project_btn">+</button>
        <div class="project_list"></div>
    </div>
    <form id="project_details_form">
        <?php
             
                $args = array(
                    'post_type' => 'projects',
                    'posts_per_page' => -1, 
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $project_query = new WP_Query($args);

                
                if ($project_query->have_posts()) : ?>
        <select name="project" id="project">
            <?php
                      
                        while ($project_query->have_posts()) : $project_query->the_post();
                         
                            $post_id = get_the_ID();
                        ?>
                        
            <option value="">Select a Project</option>
            <option value="<?php echo $post_id; ?>"><?php the_title(); ?></option>
            <?php endwhile; ?>
            <?php
                   
                    wp_reset_postdata();

                else : ?>
            <p>No projects found.</p>
            <?php endif; ?>
        </select>
        <textarea placeholder="Enter project details" name="projectd_details" id="projectd_details"></textarea>
        <input type="date" name="due_date" id="due_date">
        <select name="priority" id="priority">
            <option value="">Select priority</option>
            <option value="low">low</option>
            <option value="medium">medium</option>
            <option value="high">high</option>
        </select>
        <select name="status" id="status">
            <option value="">Status</option>
            <option value="started">started</option>
            <option value="In progress">In progress</option>
            <option value="Done">Done</option>
        </select>
        <button type="submit">Submit</button>
    </form>


    <form id="add_member_to_project">
        <h1>Add member to project</h1>
        </select>
        <?php
                $args = array(
                    'post_type' => 'team',
                    'posts_per_page' => -1, 
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'ASC'
                );

                $team_query = new WP_Query($args);

             
                if ($team_query->have_posts()) : ?>
        <select  id="selected_team">
        <option value="">Select from Team</option>
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
        <select  id="member">
            <option value="">Select Member</option>
        </select>

        <button type="submit">Add Member</button>
    </form>
</div>
