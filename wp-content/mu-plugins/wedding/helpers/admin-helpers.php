<?php

function remove_default_post_type_menu() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_default_post_type_menu' );

function remove_editor() {
    remove_post_type_support('page', 'editor');
}
add_action('admin_init', 'remove_editor');