<?php
/*
Plugin Name: Search API
Description: Search API for Guests
Author: Matias Berger
Version: 1.0.0
*/

function search_guest_cpt_by_title($request) {
    $search_string = sanitize_text_field( $request['search_string'] );
    $args = array(
        'post_type' => 'guests',
        's' => $search_string,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $args );

    $output= [];
    foreach ($query->posts as $post) {
        $output[] = [
            'id'=> $post->ID,
            'name'=> $post->post_title,
        ];
    }

    return new WP_REST_Response( $output, 200 );
}

function register_search_api(){
    $namespace = 'search-api/v1';
    $route = '/search_guest_cpt_by_title/(?P<search_string>\S+)';
    $args = [
        'methods'  => 'GET',
        'callback' => 'search_guest_cpt_by_title',
        'permission_callback'   => '__return_true',
    ];

    register_rest_route($namespace,$route,$args);
}

add_action( 'rest_api_init','register_search_api');