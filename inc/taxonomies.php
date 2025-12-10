<?php
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