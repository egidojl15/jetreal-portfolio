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
            <h2>Skills & Expertise</h2>
            
            <div class="skills-grid">
                
                <div class="skill-category">
                    <h3>Frontend</h3>
                    <ul class="skill-list">
                        <li>HTML & CSS</li>
                        <li>JavaScript</li>
                        <li>React.js</li>
                        <li>Responsive Design</li>
                    </ul>
                </div>
                
                <div class="skill-category">
                    <h3>Backend</h3>
                    <ul class="skill-list">
                        <li>PHP</li>
                        <li>WordPress</li>
                        <li>MySQL</li>
                        <li>REST APIs</li>
                    </ul>
                </div>
                
                <div class="skill-category">
                    <h3>Tools & Other</h3>
                    <ul class="skill-list">
                        <li>Git & GitHub</li>
                        <li>VS Code</li>
                        <li>Figma</li>
                        <li>Xampp</li>
                        <li>MySQL Workbench</li>
                        <li>Excel</li>
                        <li>PostgreSQL</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </section>

    
</main>

<?php
get_footer();