<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Portfolio_Theme
 */

?>
	<!doctype html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'my-portfolio-theme' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="header-container">
				<div class="header-branding">
					<?php
					// Display logo with text
					if ( has_custom_logo() ) {
						?>
						<div class="logo-container">
							<?php the_custom_logo(); ?>
							<div class="site-titles">
								<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif; ?>
								
								<?php
								$my_portfolio_theme_description = get_bloginfo( 'description', 'display' );
								if ( $my_portfolio_theme_description || is_customize_preview() ) :
								?>
									<p class="site-description"><?php echo $my_portfolio_theme_description; ?></p>
								<?php endif; ?>
							</div>
						</div>
						<?php
					} else {
						// Fallback branding without logo
						?>
						<div class="logo-container">
							<div class="logo-placeholder">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<span class="logo-initials">JETREAL</span>
								</a>
							</div>
							<div class="site-titles">
								<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif; ?>
								
								<?php
								$my_portfolio_theme_description = get_bloginfo( 'description', 'display' );
								if ( $my_portfolio_theme_description || is_customize_preview() ) :
								?>
									<p class="site-description"><?php echo $my_portfolio_theme_description; ?></p>
								<?php endif; ?>
							</div>
						</div>
						<?php
					}
					?>

				</div><!-- .header-branding -->

				<nav id="site-navigation" class="main-navigation">

					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="menu-toggle-bar"></span>
						<span class="menu-toggle-bar"></span>
						<span class="menu-toggle-bar"></span>
						<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'my-portfolio-theme' ); ?></span>
					</button>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'nav-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
		</header><!-- #masthead -->
