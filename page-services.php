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
        <p class="services-subtitle">Professional web development solutions tailored to your needs</p>
    </div>
</section>

<!-- Services Content -->
<main id="primary" class="site-main services-page">
    
    <?php
    while (have_posts()) :
        the_post();
        ?>
        
        <!-- Intro Section (Optional - uses page content) -->
        <?php if (get_the_content()) : ?>
            <section class="services-intro">
                <div class="services-intro-content">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endif; ?>
        
    <?php endwhile; ?>
    
    <!-- Services Grid -->
    <section class="services-grid-section">
        <div class="services-container">
            
            <div class="services-grid">
                
                <!-- Service 1: Web Development -->
                <div class="service-card">
                    <div class="service-icon">💻</div>
                    <h3 class="service-title">Web Development</h3>
                    <p class="service-description">
                        Custom websites and web applications built with modern technologies. 
                        From simple landing pages to complex web platforms.
                    </p>
                    <ul class="service-features">
                        <li>Responsive Design</li>
                        <li>Fast Loading Speed</li>
                        <li>SEO Optimized</li>
                        <li>Cross-browser Compatible</li>
                    </ul>
                </div>
                
                <!-- Service 2: WordPress Development -->
                <div class="service-card featured">
                    <div class="featured-badge">Popular</div>
                    <div class="service-icon">🔧</div>
                    <h3 class="service-title">WordPress Development</h3>
                    <p class="service-description">
                        Custom WordPress themes and plugins. Turn your vision into a 
                        fully functional WordPress website.
                    </p>
                    <ul class="service-features">
                        <li>Custom Themes</li>
                        <li>Plugin Development</li>
                        <li>WooCommerce Integration</li>
                        <li>Website Maintenance</li>
                    </ul>
                </div>
                
                <!-- Service 3: UI/UX Design -->
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3 class="service-title">UI/UX Design</h3>
                    <p class="service-description">
                        Beautiful, intuitive designs that provide exceptional user experiences 
                        and drive conversions.
                    </p>
                    <ul class="service-features">
                        <li>Wireframing & Prototyping</li>
                        <li>User Research</li>
                        <li>Visual Design</li>
                        <li>Usability Testing</li>
                    </ul>
                </div>
                
                <!-- Service 4: E-commerce Solutions -->
                <div class="service-card">
                    <div class="service-icon">🛒</div>
                    <h3 class="service-title">E-commerce Solutions</h3>
                    <p class="service-description">
                        Complete online store setup with payment integration, inventory 
                        management, and shipping solutions.
                    </p>
                    <ul class="service-features">
                        <li>WooCommerce Setup</li>
                        <li>Payment Gateway Integration</li>
                        <li>Product Management</li>
                        <li>Shopping Cart Optimization</li>
                    </ul>
                </div>
                
                <!-- Service 5: Website Optimization -->
                <div class="service-card">
                    <div class="service-icon">⚡</div>
                    <h3 class="service-title">Website Optimization</h3>
                    <p class="service-description">
                        Improve your website's performance, speed, and search engine rankings 
                        for better results.
                    </p>
                    <ul class="service-features">
                        <li>Speed Optimization</li>
                        <li>SEO Implementation</li>
                        <li>Mobile Optimization</li>
                        <li>Security Hardening</li>
                    </ul>
                </div>
                
                <!-- Service 6: Maintenance & Support -->
                <div class="service-card">
                    <div class="service-icon">🛡️</div>
                    <h3 class="service-title">Maintenance & Support</h3>
                    <p class="service-description">
                        Ongoing website maintenance, updates, backups, and technical support 
                        to keep your site running smoothly.
                    </p>
                    <ul class="service-features">
                        <li>Regular Updates</li>
                        <li>Security Monitoring</li>
                        <li>Backup Management</li>
                        <li>Technical Support</li>
                    </ul>
                </div>
                
            </div>
            
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="services-cta">
        <div class="services-cta-content">
            <h2 class="cta-title">Ready to Start Your Project?</h2>
            <p class="cta-description">Let's work together to bring your ideas to life</p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Get in Touch</a>
        </div>
    </section>
    
</main>

<?php
get_footer();