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
	wp_style_add_data( 'my-portfolio-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'my-portfolio-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_portfolio_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

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

/**
 * Register Custom Taxonomies
 */
function my_portfolio_register_taxonomies() {
    
    // Register Project Type taxonomy
    register_taxonomy('project_type', 'project', array(
        'labels' => array(
            'name' => 'Project Types',
            'singular_name' => 'Project Type',
            'search_items' => 'Search Project Types',
            'all_items' => 'All Project Types',
            'edit_item' => 'Edit Project Type',
            'update_item' => 'Update Project Type',
            'add_new_item' => 'Add New Project Type',
            'new_item_name' => 'New Project Type Name',
            'menu_name' => 'Project Types',
        ),
        'hierarchical' => true, // Like categories (can have parent/child)
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'project-type'),
        'show_in_rest' => true,
    ));
    
    // Register Tech Category taxonomy
    register_taxonomy('tech_category', 'tech_stack', array(
        'labels' => array(
            'name' => 'Tech Categories',
            'singular_name' => 'Tech Category',
            'search_items' => 'Search Tech Categories',
            'all_items' => 'All Tech Categories',
            'edit_item' => 'Edit Tech Category',
            'update_item' => 'Update Tech Category',
            'add_new_item' => 'Add New Tech Category',
            'new_item_name' => 'New Tech Category Name',
            'menu_name' => 'Tech Categories',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tech-category'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'my_portfolio_register_taxonomies');

/**
 * Add Meta Boxes for Projects
 */
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

/**
 * Display Meta Box HTML
 */
function my_portfolio_project_details_html($post) {
    // Security nonce field
    wp_nonce_field('my_portfolio_save_project_details', 'my_portfolio_project_details_nonce');
    
    // Get existing values
    $client_name = get_post_meta($post->ID, '_project_client_name', true);
    $project_url = get_post_meta($post->ID, '_project_url', true);
    $completion_date = get_post_meta($post->ID, '_project_completion_date', true);
    $responsibilities = get_post_meta($post->ID, '_project_responsibilities', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="project_client_name">Client Name</label></th>
            <td>
                <input type="text" 
                       id="project_client_name" 
                       name="project_client_name" 
                       value="<?php echo esc_attr($client_name); ?>" 
                       class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="project_url">Project URL</label></th>
            <td>
                <input type="url" 
                       id="project_url" 
                       name="project_url" 
                       value="<?php echo esc_url($project_url); ?>" 
                       class="regular-text"
                       placeholder="https://example.com">
            </td>
        </tr>
        <tr>
            <th><label for="project_completion_date">Completion Date</label></th>
            <td>
                <input type="date" 
                       id="project_completion_date" 
                       name="project_completion_date" 
                       value="<?php echo esc_attr($completion_date); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="project_responsibilities">Responsibilities / Role</label></th>
            <td>
                <textarea id="project_responsibilities" 
                          name="project_responsibilities" 
                          rows="5" 
                          class="large-text"><?php echo esc_textarea($responsibilities); ?></textarea>
                <p class="description">Describe your role and responsibilities in this project.</p>
            </td>
        </tr>

        <tr>
            <th><label for="project_tech_stack">Tech Stack</label></th>
            <td>
                <?php
                // Get all tech stack items
                $tech_items = get_posts(array(
                    'post_type' => 'tech_stack',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC'
                ));
                
                // Get currently selected tech stack IDs
                $selected_tech = get_post_meta($post->ID, '_project_tech_stack', true);
                if (!is_array($selected_tech)) {
                    $selected_tech = array();
                }
                
                if ($tech_items) :
                    echo '<div style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">';
                    foreach ($tech_items as $tech) :
                        $checked = in_array($tech->ID, $selected_tech) ? 'checked' : '';
                        ?>
                        <label style="display: block; margin-bottom: 5px;">
                            <input type="checkbox" 
                                   name="project_tech_stack[]" 
                                   value="<?php echo $tech->ID; ?>" 
                                   <?php echo $checked; ?>>
                            <?php echo esc_html($tech->post_title); ?>
                        </label>
                        <?php
                    endforeach;
                    echo '</div>';
                else :
                    echo '<p>No technologies found. <a href="' . admin_url('post-new.php?post_type=tech_stack') . '">Add some technologies first</a>.</p>';
                endif;
                ?>
                <p class="description">Select the technologies used in this project.</p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Meta Box Data
 */
function my_portfolio_save_project_details($post_id) {
    // Security checks
    if (!isset($_POST['my_portfolio_project_details_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['my_portfolio_project_details_nonce'], 'my_portfolio_save_project_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save the fields
    if (isset($_POST['project_client_name'])) {
        update_post_meta($post_id, '_project_client_name', sanitize_text_field($_POST['project_client_name']));
    }
    if (isset($_POST['project_url'])) {
        update_post_meta($post_id, '_project_url', esc_url_raw($_POST['project_url']));
    }
    if (isset($_POST['project_completion_date'])) {
        update_post_meta($post_id, '_project_completion_date', sanitize_text_field($_POST['project_completion_date']));
    }
    if (isset($_POST['project_responsibilities'])) {
        update_post_meta($post_id, '_project_responsibilities', sanitize_textarea_field($_POST['project_responsibilities']));
    }
    // Save tech stack
    if (isset($_POST['project_tech_stack']) && is_array($_POST['project_tech_stack'])) {
        $tech_stack = array_map('intval', $_POST['project_tech_stack']);
        update_post_meta($post_id, '_project_tech_stack', $tech_stack);
    } else {
        // If no checkboxes selected, delete the meta
        delete_post_meta($post_id, '_project_tech_stack');
    }
}
add_action('save_post', 'my_portfolio_save_project_details');
