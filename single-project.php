<?php
/**
 * Single Project Template - Improved Version
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
                
                <!-- Hero Header Section -->
                <header class="entry-header">
                    <div class="header-content">
                        <?php if ($terms && !is_wp_error($terms)) : ?>
                            <div class="project-category">
                                <?php
                                $term_names = array();
                                foreach ($terms as $term) {
                                    $term_names[] = $term->name;
                                }
                                echo esc_html(implode(', ', $term_names));
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
                        <?php if ($client_name) : ?>
                            <p class="client-name">Client: <?php echo esc_html($client_name); ?></p>
                        <?php endif; ?>
                    </div>
                </header>
                
                <!-- Project Photo -->
                <?php if ($project_photo_url) : ?>
                    <div class="project-photo-container">
                        <img src="<?php echo esc_url($project_photo_url); ?>" alt="<?php the_title(); ?>" class="project-photo">
                    </div>
                <?php endif; ?>
                
                <!-- Two Column Layout -->
                <div class="project-content-wrapper">
                    
                    <!-- Main Content Column -->
                    <div class="project-main-content">
                        
                        <!-- Project Details Cards -->
                        <div class="project-details">
                            
                            <?php if ($completion_date) : ?>
                                <div class="detail-item">
                                    <span class="detail-label">Completed</span>
                                    <span class="detail-value"><?php echo esc_html(date('F Y', strtotime($completion_date))); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($project_url) : ?>
                                <div class="detail-item">
                                    <span class="detail-label">Project URL</span>
                                    <a href="<?php echo esc_url($project_url); ?>" target="_blank" class="detail-value detail-link">
                                        View Live Project →
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                        
                        <!-- Project Description -->
                        <div class="project-content">
                            <div class="entry-content">
                                <h2>Project Overview</h2>
                                <?php the_content(); ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Sidebar Column -->
                    <aside class="project-sidebar">
                        
                        <?php if ($responsibilities) : ?>
                            <div class="sidebar-card project-responsibilities">
                                <h3>My Role & Responsibilities</h3>
                                <div class="responsibilities-content">
                                    <?php echo nl2br(esc_html($responsibilities)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        // Get and display tech stack
                        $tech_stack_ids = get_post_meta(get_the_ID(), '_project_tech_stack', true);
                        
                        if ($tech_stack_ids && is_array($tech_stack_ids)) :
                            ?>
                            <div class="sidebar-card project-tech-stack">
                                <h3>Technologies Used</h3>
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
                        
                    </aside>
                    
                </div>
                
            </article>
            
        <?php endwhile; ?>

    </main>
</div>

<?php
get_footer();