<?php

function my_portfolio_add_project_meta_boxes() {
    add_meta_box(
        'project_details',                  // Meta box ID
        'Project Details',                  // Title shown in editor
        'my_portfolio_project_details_html', // Callback function (we'll create this next)
        'project',                          // Post type
        'normal',                           // Position (normal, side, advanced)
        'high'                              // Priority
    );
}
add_action('add_meta_boxes', 'my_portfolio_add_project_meta_boxes');

function my_portfolio_project_details_html($post) {
    // Security nonce field
    wp_nonce_field('my_portfolio_save_project_details', 'my_portfolio_project_details_nonce');
    
    // Get existing values
    $client_name = get_post_meta($post->ID, '_project_client_name', true);
    $project_url = get_post_meta($post->ID, '_project_url', true);
    $completion_date = get_post_meta($post->ID, '_project_completion_date', true);
    $responsibilities = get_post_meta($post->ID, '_project_responsibilities', true);
    $project_photo_url = get_post_meta($post->ID, '_project_photo_url', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="project_client_name">Client Name</label></th>
            <td>
                <input type="text" 
                       id="project_client_name" 
                       name="project_client_name" 
                       value="<?php echo esc_attr($client_name); ?>" 
                       class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="project_url">Project URL</label></th>
            <td>
                <input type="url" 
                       id="project_url" 
                       name="project_url" 
                       value="<?php echo esc_url($project_url); ?>" 
                       class="regular-text"
                       placeholder="https://example.com">
            </td>
        </tr>
        <tr>
            <th><label for="project_photo_url">Photo URL</label></th>
            <td>
                <input type="url" 
                       id="project_photo_url" 
                       name="project_photo_url" 
                       value="<?php echo esc_url($project_photo_url); ?>" 
                       class="regular-text"
                       placeholder="https://example.com">
            </td>
        </tr>
        <tr>
            <th><label for="project_completion_date">Completion Date</label></th>
            <td>
                <input type="date" 
                       id="project_completion_date" 
                       name="project_completion_date" 
                       value="<?php echo esc_attr($completion_date); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="project_responsibilities">Responsibilities / Role</label></th>
            <td>
                <textarea id="project_responsibilities" 
                          name="project_responsibilities" 
                          rows="5" 
                          class="large-text"><?php echo esc_textarea($responsibilities); ?></textarea>
                <p class="description">Describe your role and responsibilities in this project.</p>
            </td>
        </tr>

        <tr>
            <th><label for="project_tech_stack">Tech Stack</label></th>
            <td>
                <?php
                // Get all tech stack items
                $tech_items = get_posts(array(
                    'post_type' => 'tech_stack',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC'
                ));
                
                // Get currently selected tech stack IDs
                $selected_tech = get_post_meta($post->ID, '_project_tech_stack', true);
                if (!is_array($selected_tech)) {
                    $selected_tech = array();
                }
                
                if ($tech_items) :
                    echo '<div style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">';
                    foreach ($tech_items as $tech) :
                        $checked = in_array($tech->ID, $selected_tech) ? 'checked' : '';
                        ?>
                        <label style="display: block; margin-bottom: 5px;">
                            <input type="checkbox" 
                                   name="project_tech_stack[]" 
                                   value="<?php echo $tech->ID; ?>" 
                                   <?php echo $checked; ?>>
                            <?php echo esc_html($tech->post_title); ?>
                        </label>
                        <?php
                    endforeach;
                    echo '</div>';
                else :
                    echo '<p>No technologies found. <a href="' . admin_url('post-new.php?post_type=tech_stack') . '">Add some technologies first</a>.</p>';
                endif;
                ?>
                <p class="description">Select the technologies used in this project.</p>
            </td>
        </tr>
    </table>
    <?php
}


// About me page tech stack meta box
// Add meta box for page tech stack selection
function add_page_tech_stack_meta_box() {
    $screen = get_current_screen();
    
    // Only add on the edit page screen AND if it's the about page
    if ($screen->id === 'page') {
        global $post;
        if ($post && $post->post_name === 'about-me') { // Change 'about' to your page slug
            add_meta_box(
                'page_tech_stack',
                'Select Skills to Display',
                'render_page_tech_stack_meta_box',
                'page',
                'normal',
                'high'
            );
        }
    }
}
add_action('add_meta_boxes', 'add_page_tech_stack_meta_box');


// Render the meta box
function render_page_tech_stack_meta_box($post) {
    wp_nonce_field('page_tech_stack_nonce', 'page_tech_stack_nonce_field');
    
    $selected_tech = get_post_meta($post->ID, '_page_tech_stack', true);
    if (!is_array($selected_tech)) {
        $selected_tech = array();
    }
    
    $tech_posts = get_posts(array(
        'post_type' => 'tech_stack',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    
    echo '<div style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">';
    foreach ($tech_posts as $tech) {
        $checked = in_array($tech->ID, $selected_tech) ? 'checked' : '';
        echo '<label style="display: block; margin-bottom: 5px;">';
        echo '<input type="checkbox" name="page_tech_stack[]" value="' . $tech->ID . '" ' . $checked . '> ';
        echo esc_html($tech->post_title);
        echo '</label>';
    }
    echo '</div>';
}
