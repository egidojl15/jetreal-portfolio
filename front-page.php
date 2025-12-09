    <?php get_header(); ?>

    <section class="hero">
        <h1>Hi, I'm Jetler Egido</h1>
        <p>Welcome to my portfolio website!</p>

        <section class="my-hero-image">
            <img src="<?php echo get_template_directory_uri(); ?>/images/oka.jpg" alt="Hero Image" class="hero-image">
        </section>

    </section>

        <!-- <div class="about-container">
            <section class="about">
                <?php
                // Get the About Me page (ID: 16)
                $about_page = get_post(16);
                
                if ($about_page) {
                    echo '<h2>' . esc_html($about_page->post_title) . '</h2>';
                    echo '<div>' . apply_filters('the_content', $about_page->post_content) . '</div>';
                }
                ?>
            </section>
        </div> -->

    <section class="projects">
        <h2>Projects</h2>

        <div class="project-grid">
            <?php
            // Query to get projects
            $args = array(
                'post_type' => 'project',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $projects = new WP_Query($args);
            
            // The Loop
            if ($projects->have_posts()) :
                while ($projects->have_posts()) : $projects->the_post();
                    ?>
                    
                    <div class="project-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="project-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <h3><?php the_title(); ?></h3>
                        
                        <?php
                        // Get project type
                        $terms = get_the_terms(get_the_ID(), 'project_type');
                        if ($terms && !is_wp_error($terms)) :
                            $term_names = array();
                            foreach ($terms as $term) {
                                $term_names[] = $term->name;
                            }
                            echo '<p class="project-type"><strong>Type:</strong> ' . implode(', ', $term_names) . '</p>';
                        endif;
                        
                        // Get custom fields
                        $client_name = get_post_meta(get_the_ID(), '_project_client_name', true);
                        $completion_date = get_post_meta(get_the_ID(), '_project_completion_date', true);
                        
                        // Display client name if exists
                        if ($client_name) :
                            echo '<p class="project-client"><strong>Client:</strong> ' . esc_html($client_name) . '</p>';
                        endif;
                        
                        // Display completion date if exists
                        if ($completion_date) :
                            echo '<p class="project-date"><strong>Completed:</strong> ' . esc_html(date('F Y', strtotime($completion_date))) . '</p>';
                        endif;
                        
                        // Display tech stack
                        $tech_stack_ids = get_post_meta(get_the_ID(), '_project_tech_stack', true);
                        if ($tech_stack_ids && is_array($tech_stack_ids)) :
                            echo '<div class="project-card-tech">';
                            echo '<strong>Tech:</strong> ';
                            $tech_names = array();
                            foreach ($tech_stack_ids as $tech_id) :
                                $tech_post = get_post($tech_id);
                                if ($tech_post) :
                                    $tech_names[] = '<span class="tech-badge">' . esc_html($tech_post->post_title) . '</span>';
                                endif;
                            endforeach;
                            echo implode(' ', $tech_names);
                            echo '</div>';
                        endif;
                        ?>
                        
                        <div class="project-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="project-link">View Project →</a>
                    </div>
                    
                    <?php
                endwhile;
                wp_reset_postdata(); // Reset post data
            else :
                echo '<p>No projects found. Add some projects in the admin!</p>';
            endif;
            ?>
        </div>
    </section>

    <?php get_footer(); ?>