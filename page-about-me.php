<?php
/**
 * Template Name: About Me Page
 * 
 * Custom template for the About Me page
 * 
 * @package My_Portfolio_Theme
 */

get_header();
?>

<!-- About Me Header -->
<section class="about-me-header">
    <div class="about-me-header-content">
        <h1 class="about-me-title"><?php the_title(); ?></h1>
        <p class="about-me-subtitle">Learn more about my journey and experience</p>
    </div>
</section>

<!-- About Me Content -->
<main id="primary" class="site-main about-me-page">
    
    <?php
    while (have_posts()) :
        the_post();
        
        ?>
        
        <div class="about-me-container">
            
            <!-- Featured Image (Optional) -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="about-me-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            
            <!-- About Me Content -->
            <div class="about-me-content">
                <?php the_content(); ?>
            </div>
            
        </div>
        
    <?php endwhile; ?>
    
    <!-- Skills Section (Optional - you can customize this) -->
    <section class="skills-section">
    <div class="skills-container">
        <h2>Skills & Technologies</h2>

        <div class="skills-grid">

            <?php 
            // Get all Tech Categories
            $tech_categories = get_terms(array(
                'taxonomy' => 'tech_category',
                'hide_empty' => false,
            ));

            if (!empty($tech_categories) && !is_wp_error($tech_categories)) :
                foreach ($tech_categories as $category) :
            ?>
                <div class="skill-category">
                    <h3><?php echo $category->name; ?></h3>

                    <ul class="skill-list">
                        <?php
                        // Get tech items inside this category
                        $tech_items = get_posts(array(
                            'post_type' => 'tech_stack',
                            'numberposts' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'tech_category',
                                    'field'    => 'term_id',
                                    'terms'    => $category->term_id,
                                )
                            ),
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));

                        if ($tech_items) :
                            foreach ($tech_items as $tech) :
                        ?>
                                <li><?php echo esc_html($tech->post_title); ?></li>
                        <?php 
                            endforeach;
                        else :
                            echo "<li>No skills added yet.</li>";
                        endif; 
                        ?>
                    </ul>
                </div>

            <?php 
                endforeach;
            endif; 
            ?>

        </div>
    </div>
</section>

    
</main>

<?php
get_footer();