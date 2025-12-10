<?php
/**
 * My Portfolio Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package My_Portfolio_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_portfolio_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on My Portfolio Theme, use a find and replace
		* to change 'my-portfolio-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'my-portfolio-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'my-portfolio-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'my_portfolio_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
                'height'        => 200,
                'width'         => 200,
                'flex-height'   => true,
                'flex-width'    => true,
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'my_portfolio_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_portfolio_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'my_portfolio_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'my_portfolio_theme_content_width', 0 );


// Taxonomies and Custom Post Types
require_once get_template_directory() . '/inc/taxonomies.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/meta-save.php';

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_portfolio_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'my-portfolio-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'my-portfolio-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'my_portfolio_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_portfolio_theme_scripts() {
	wp_enqueue_style( 'my-portfolio-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	
	wp_enqueue_style('my-portfolio-theme-page-about-me', get_template_directory_uri() . '/styles/about-me.css', array('my-portfolio-theme-style'), _S_VERSION);
	wp_enqueue_style('my-portfolio-theme-home', get_template_directory_uri() . '/styles/home.css', array('my-portfolio-theme-style'), _S_VERSION);

	wp_style_add_data( 'my-portfolio-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'my-portfolio-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_portfolio_theme_scripts' );


/**
 * Register Custom Post Types
 */
function my_portfolio_register_post_types() {
    
    // Register Project CPT
    register_post_type('project', array(
        'labels' => array(
            'name' => 'Projects',
            'singular_name' => 'Project',
            'add_new' => 'Add New Project',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'new_item' => 'New Project',
            'view_item' => 'View Project',
            'search_items' => 'Search Projects',
            'not_found' => 'No projects found',
            'not_found_in_trash' => 'No projects found in Trash'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true, // Enables block editor
    ));
    
    // Register Tech Stack CPT
    register_post_type('tech_stack', array(
        'labels' => array(
            'name' => 'Tech Stack',
            'singular_name' => 'Technology',
            'add_new' => 'Add New Technology',
            'add_new_item' => 'Add New Technology',
            'edit_item' => 'Edit Technology',
            'new_item' => 'New Technology',
            'view_item' => 'View Technology',
            'search_items' => 'Search Technologies',
            'not_found' => 'No technologies found',
            'not_found_in_trash' => 'No technologies found in Trash'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-editor-code',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'tech-stack'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'my_portfolio_register_post_types');

function my_portfolio_add_project_meta_boxes() {
    add_meta_box(
        'project_details',                  // Meta box ID
        'Project Details',                  // Title shown in editor
        'my_portfolio_project_details_html', // Callback function (we'll create this next)
        'project',                          // Post type
        'normal',                           // Position (normal, side, advanced)
        'high'                              // Priority
    );
}
add_action('add_meta_boxes', 'my_portfolio_add_project_meta_boxes');

