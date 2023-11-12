<?php
function enqueue_custom_js() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap', false );
    wp_enqueue_style( 'google-fonts-ooh', 'https://fonts.googleapis.com/css2?family=Parisienne&display=swap', false );

    wp_register_script( 'guests-list-js', get_template_directory_uri() . '/js/guests-list.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'guests-list-js' );

    wp_register_script( 'header-menu-js', get_template_directory_uri() . '/js/header-menu.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'header-menu-js' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_js' );