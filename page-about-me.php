<?php
    get_header();
?>

<section class="about-me-header">
    <div class="about-me-header-content">
        <h1 class="about-me-title"><?php the_title(); ?></h1>
        <p class="about-me-subtitle">Learn more about my journey and experience</p>
    </div>
</section>

<section class="skills-section">
        <div class="skills-container">
            <h2>Skills & Technologies</h2>
            
            <div class="skills-grid">
                <?php
                // Get tech stack specifically assigned to this page
                $page_tech_ids = get_post_meta(get_the_ID(), '_page_tech_stack', true);
                
                if ($page_tech_ids && is_array($page_tech_ids)) {
                    // Dynamically organize by category
                    $tech_by_category = array();
                    
                    foreach ($page_tech_ids as $tech_id) {
                        $tech_post = get_post($tech_id);
                        if ($tech_post) {
                            $tech_name = $tech_post->post_title;
                            
                            // Get the category from WordPress taxonomy
                            $terms = get_the_terms($tech_id, 'tech_category');
                            
                            if ($terms && !is_wp_error($terms)) {
                                // Use the first category assigned
                                $category = $terms[0]->name;
                                
                                // Create category array if it doesn't exist
                                if (!isset($tech_by_category[$category])) {
                                    $tech_by_category[$category] = array();
                                }
                                
                                // Add tech to category
                                $tech_by_category[$category][] = $tech_name;
                            }
                        }
                    }
                    
                    // Display each category
                    foreach ($tech_by_category as $category => $technologies) :
                        if (!empty($technologies)) :
                            // Sort alphabetically
                            sort($technologies);
                            ?>
                            <div class="skill-category">
                                <h3><?php echo esc_html($category); ?></h3>
                                <ul class="skill-list">
                                    <?php foreach ($technologies as $tech) : ?>
                                        <li><?php echo esc_html($tech); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php
                        endif;
                    endforeach;
                } else {
                    echo '<p>No skills selected for this page.</p>';
                }
                ?>
                
            </div>
        </div>
    </section>
<?php
get_footer();