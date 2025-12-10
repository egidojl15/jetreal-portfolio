<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Portfolio_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-container">
			
			<!-- Footer Top Section -->
			<div class="footer-top">
				<div class="footer-branding">
					<?php if ( has_custom_logo() ) : ?>
						<div class="footer-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<div class="footer-logo-placeholder">
							<span class="footer-logo-initials"><?php echo substr(get_bloginfo('name'), 0, 2); ?></span>
						</div>
					<?php endif; ?>
					
					<div class="footer-titles">
						<h3 class="footer-site-title"><?php bloginfo('name'); ?></h3>
						<p class="footer-tagline"><?php bloginfo('description'); ?></p>
					</div>
				</div>

			<div class="footer-container"><!-- Social Media Links -->
					<div class="footer-social">
						<h4>Connect With Me</h4>
						<div class="social-links">
							<a href="https://linkedin.com/in/yourprofile" target="_blank" rel="noopener noreferrer" class="social-link linkedin">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
									<rect x="2" y="9" width="4" height="12"></rect>
									<circle cx="4" cy="4" r="2"></circle>
								</svg>
								<span>LinkedIn</span>
							</a>
							<a href="https://github.com/egidojl15" target="_blank" rel="noopener noreferrer" class="social-link github">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
								</svg>
								<span>GitHub</span>
							</a>
							<a href="https://facebook.com/mr.potato15" target="_blank" rel="noopener noreferrer" class="social-link facebook">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
									<path d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.326 
									24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 
									4.659-4.788 1.325 0 2.464.099 2.795.143v3.24l-1.918.001c-1.504 
									0-1.796.715-1.796 1.764v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.403 
									24 24 23.403 24 22.674V1.326C24 .597 23.403 0 22.675 0z"/>
								</svg>
								<span>Facebook</span>
							</a>

							<a href="mailto:you@example.com" class="social-link email">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
									<polyline points="22,6 12,13 2,6"></polyline>
								</svg>
								<span>Email</span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer Navigation -->
			<div class="footer-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>

			<!-- Footer Bottom Section -->
			<div class="footer-bottom">
				<div class="footer-copyright">
					<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>

				<div class="footer-credits">
					<p>
						Designed & Developed by 
						<h5 class="footer-jet">Jetler Egido</h5>
					</p>
				</div>
			</div>

		</div><!-- .footer-container -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>