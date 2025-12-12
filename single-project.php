<?php
/**
 * Single Project Template
 */

get_header();
?>
<div class="single-project-container">
<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
        
        // Get custom field values
        $client_name = get_post_meta(get_the_ID(), '_project_client_name', true);
        $project_url = get_post_meta(get_the_ID(), '_project_url', true);
        $completion_date = get_post_meta(get_the_ID(), '_project_completion_date', true);
        $responsibilities = get_post_meta(get_the_ID(), '_project_responsibilities', true);
        $project_photo_url = get_post_meta(get_the_ID(), '_project_photo_url', true);
        
        // Get project type
        $terms = get_the_terms(get_the_ID(), 'project_type');
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <?php if ($terms && !is_wp_error($terms)) : ?>
                    <div class="project-meta">
                        <strong>Project Type: </strong> 
                        <?php
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        echo implode(', ', $term_names);
                        ?>
                    </div>
                <?php endif; ?>
            </header>
            
            
            <!-- Display the featured image on single image -->
            <!-- <?php if (has_post_thumbnail()) : ?>
                <div class="project-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?> -->
            
            <div class="project-details">
                
                <?php if ($client_name) : ?>
                    <div class="detail-item">
                        <strong>Client: </strong> <?php echo esc_html($client_name); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($completion_date) : ?>
                    <div class="detail-item">
                        <strong>Completed: </strong> <?php echo esc_html(date('F Y', strtotime($completion_date))); ?>
                    </div>
                <?php endif; ?>

                <?php
                    /* ---------- Type (taxonomy: project_type) ---------- */
                        $terms = get_the_terms(get_the_ID(), 'project_type');
                        if ($terms && !is_wp_error($terms)) :
                            $term_names = array();
                            foreach ($terms as $term) {
                                $term_names[] = $term->name;
                            }
                            ?>
                            <div class="detail-item">
                                <strong>Project Type: </strong>
                                <?php echo esc_html(implode(', ', $term_names)); ?>
                            </div>
                <?php   endif; ?>
                
                <?php if ($project_url) : ?>
                    <div class="detail-item">
                        <strong>Project URL: </strong> <a href="<?php echo esc_url($project_url); ?>" target="_blank"><?php echo esc_html($project_url); ?></a>
                    </div>
                <?php endif; ?>

            </div>

            <div>
                <?php if ($project_photo_url) : ?>
                    <div class="project-photo">
                        <img src="<?php echo esc_url($project_photo_url); ?>" alt="Project Photo" style="max-width:100%; height:auto;">
                    </div>
                <?php endif; ?>
                
            </div>
            
            <div class="project-content">

                <div class="entry-content">
                    <h2>Project Description: </h2>
                    <?php the_content(); ?>
                </div>
            </div>

                <?php if ($responsibilities) : ?>
                    <div class="project-responsibilities">
                        <h3>My Role & Responsibilities: </h3>
                        <p><?php echo nl2br(esc_html($responsibilities)); ?></p>
                    </div>
                <?php endif; ?>
                

            <?php
            // Get and display tech stack
            $tech_stack_ids = get_post_meta(get_the_ID(), '_project_tech_stack', true);

            if ($tech_stack_ids && is_array($tech_stack_ids)) :
                ?>
                <div class="project-tech-stack">
                    <h4>Tech Stack & Technologies: </h4>
                    <div class="tech-list">
                        <?php
                        foreach ($tech_stack_ids as $tech_id) :
                            $tech_post = get_post($tech_id);
                            if ($tech_post) :
                                ?>
                                <span class="tech-item"><?php echo esc_html($tech_post->post_title); ?></span>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
                <?php
            endif;
            ?>
            
        </article>
        
    <?php endwhile; ?>

</main>

</div>

<?php
get_footer();