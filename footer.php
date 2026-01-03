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

			<!-- Footer Top Section -->
			<div class="footer-container"><!-- Social Media Links -->
					<div class="footer-social">
						<h4>Connect With Me</h4>
						<div class="social-links">
							<a href="https://www.linkedin.com/in/jetler-egido-265414396/" target="_blank" rel="noopener noreferrer" class="social-link linkedin">
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

							<a href="https://wa.me/639617838413" target="_blank" rel="noopener noreferrer" class="social-link whatsapp">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
									<path d="M20.52 3.48A11.91 11.91 0 0012.05 0C5.42 0 .05 5.37.05 12c0 2.11.55 4.17 
									1.6 6L0 24l6.18-1.62a11.94 11.94 0 005.87 1.5h.01c6.63 
									0 12-5.37 12-12a11.9 11.9 0 00-3.54-8.4zM12.06 21.85a9.9 
									9.9 0 01-5.05-1.38l-.36-.21-3.67.96.98-3.58-.23-.37a9
									9.88 0 0115.26-11.6 9.86 9.86 0 012.89 7.01c0 5.45-4.44 
									9.89-9.92 9.89zm5.45-7.41c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 
									1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.61-.92-2.21-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.05 1.03-1.05 2.5s1.08 2.9 1.23 3.1c.15.2 2.12 3.24 5.14 4.54.72.31 1.28.5 1.72.64.72.23 1.37.2 1.89.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35z"/>
								</svg>
								<span>WhatsApp</span>
							</a>


							<a href="mailto:jetzkie152004@gmail.com" class="social-link email">
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
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>