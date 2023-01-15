<?php

function guests_post_type(){
    register_post_type(
        'guests',
        // CPT Options
        array(
            'labels'        => array(
                'name' => 'Guests',
                'singular_name' => 'Guest',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Guest',
                'edit_item' => 'Edit Guest',
                'new_item' => 'New Guest',
                'view_item' => 'View Guest',
                'search_items' => 'Search Guests',
                'not_found' => 'No guests found',
                'not_found_in_trash' => 'No guests found in trash',
                'parent_item_colon' => 'Parent Guest:',
                'menu_name' => 'Guests',
            ),
            'public'        => true,
            'has_archive'   => false,
            'menu_icon' => 'dashicons-admin-users',
            'supports' => array( 'title'),
        )
    );
}

add_action('init', 'guests_post_type', 0);

function remove_default_post_type_menu() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_default_post_type_menu' );