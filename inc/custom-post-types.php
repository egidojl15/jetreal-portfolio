<?php

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

	register_post_type('services', array(
		'labels' => array(
			'name' => 'Services',
			'singular_name' => 'Service',
			'add_new' => 'Add New Service',
			'add_new_item' => 'Add New Service',
			'edit_item' => 'Edit Service',
			'new_item' => 'New Service',
			'view_item' => 'View Service',
			'search_items' => 'Search Services',
			'not_found' => 'No services found',
			'not_found_in_trash' => 'No services found in Trash'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-hammer',
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		'rewrite' => array('slug' => 'services'),
		'show_in_rest' => true,
	));
}
add_action('init', 'my_portfolio_register_post_types');