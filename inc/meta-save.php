<?php
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
    if (isset($_POST['project_photo_url'])) {
        update_post_meta($post_id, '_project_photo_url', esc_url_raw($_POST['project_photo_url']));
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

// About me page tech stack meta box save
// Save the meta box data
function save_page_tech_stack_meta($post_id) {
    if (!isset($_POST['page_tech_stack_nonce_field']) || 
        !wp_verify_nonce($_POST['page_tech_stack_nonce_field'], 'page_tech_stack_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $tech_stack = isset($_POST['page_tech_stack']) ? array_map('intval', $_POST['page_tech_stack']) : array();
    update_post_meta($post_id, '_page_tech_stack', $tech_stack);
}
add_action('save_post_page', 'save_page_tech_stack_meta');

/**
 * Save service details meta box data
 */
function save_service_details_meta_box($post_id) {
    // Check nonce
    if (!isset($_POST['service_details_nonce']) || !wp_verify_nonce($_POST['service_details_nonce'], 'save_service_details')) {
        return;
    }
    
    // Check if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save featured status
    if (isset($_POST['service_featured'])) {
        update_post_meta($post_id, '_service_featured', '1');
    } else {
        delete_post_meta($post_id, '_service_featured');
    }
    
    // Save features
    if (isset($_POST['service_features'])) {
        $features = sanitize_textarea_field($_POST['service_features']);
        update_post_meta($post_id, '_service_features', $features);
    }
}
add_action('save_post_services', 'save_service_details_meta_box');