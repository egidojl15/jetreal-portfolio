<?php
/**
 * Template Name: Services Page
 * 
 * Custom template for the Services page
 * 
 * @package My_Portfolio_Theme
 */

get_header();
?>

<!-- Services Header -->
<section class="services-header">
    <div class="services-header-content">
        <h1 class="services-title">Services</h1>
        <p class="services-subtitle">Practical digital solutions designed to support your goals</p>
    </div>
</section>

<!-- Services Content -->
<main id="primary" class="site-main services-page">
    
    <!-- Services Grid -->
    <section class="services-grid-section">
        <div class="services-container">
            
            <div class="services-grid">
                
                <?php
                // Query for Services custom post type
                $args = array(
                    'post_type'      => 'services',
                    'posts_per_page' => -1, // Get all services
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                );
                
                $services_query = new WP_Query($args);
                
                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        
                        // Get custom fields
                        $is_featured = get_post_meta(get_the_ID(), '_service_featured', true);
                        $features = get_post_meta(get_the_ID(), '_service_features', true);
                        
                        // Convert features string to array if it exists
                        $features_array = array();
                        if (!empty($features)) {
                            $features_array = array_filter(array_map('trim', explode("\n", $features)));
                        }
                        ?>
                        
                        <div class="service-card <?php echo $is_featured ? 'featured' : ''; ?>">
                            <?php if ($is_featured) : ?>
                                <div class="featured-badge">Popular</div>
                            <?php endif; ?>
                            
                            <h3 class="service-title"><?php the_title(); ?></h3>
                            
                            <div class="service-description">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <?php if (!empty($features_array)) : ?>
                                <ul class="service-features">
                                    <?php foreach ($features_array as $feature) : ?>
                                        <li><?php echo esc_html($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    
                    <p>No services found. Please add some services in the WordPress admin.</p>
                    
                <?php endif; ?>
                
            </div>
            
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="services-cta">
        <div class="services-cta-content">
            <h2 class="cta-title">Ready to Start Your Project?</h2>
            <p class="cta-description">Let's work together and bring your ideas to life</p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Get in Touch</a>
        </div>
    </section>
    
</main>

<?php
get_footer();