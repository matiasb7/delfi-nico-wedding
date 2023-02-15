<?php
/*
Plugin Name: Search API
Description: Search API for Guests
Author: Matias Berger
Version: 1.0.0
*/

class SearchApi {
    protected $routes;

    public function __construct() {
        $this->init();
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function init(): void
    {
        $this->routes[] = [
            'namespace'=>'search-name-api',
            'route'=>'/search_guest_cpt_by_title/(?P<search_string>\S+)',
            'args'=> [
                'methods'  => 'GET',
                'callback' => [$this, 'search_guest_cpt_by_title'],
                'permission_callback'   => '__return_true',
            ]
        ];

        $this->routes[] = [
            'namespace'=>'upload-guest-info',
            'route'=>'/upload-guest-restriction',
            'args'=> [
                'methods'  => 'POST',
                'callback' => [$this,'upload_guest_info'],
                'permission_callback'   => '__return_true',
            ]
        ];

        $this->routes[] = [
            'namespace'=>'search-by-id',
            'route'=>'/search-by-id/(?P<search_id>\S+)',
            'args'=> [
                'methods'  => 'GET',
                'callback' => [$this,'get_info_by_id'],
                'permission_callback'   => '__return_true',
            ]
        ];


        $this->routes[] = [
            'namespace'=>'check-for-change',
            'route'=>'/check-for-change/(?P<search_id>\S+)',
            'args'=> [
                'methods'  => 'GET',
                'callback' => [$this,'check_for_change'],
                'permission_callback'   => '__return_true',
            ]
        ];
    }

    public function register_routes() {
        foreach($this->routes as $route) {
            register_rest_route($route['namespace'], $route['route'], $route['args']);
        }
    }

    public function search_guest_cpt_by_title($request) {
//        $search_string = sanitize_text_field( $request['search_string'] );
        $search_string = str_replace('%20', ' ' ,$request['search_string'] );
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
                'couple_name'=> get_field('couple',$post->ID) ?? '',
                'plus_guests' => get_field('plus_guests',$post->ID) ?? 0,
            ];
        }

        return new WP_REST_Response( $output, 200 );
    }

    public function upload_guest_info($request=NULL){

        if ($request){
            $id = $request->get_param( 'id' );

            $update = [
                'assistance_guest' =>$request->get_param( 'main' ) ,
                'assistance_couple' =>$request->get_param( 'couple' ) ,
                'assistance_plus_one' =>$request->get_param( 'plus_guest' ) ,
                'restrictions' => sanitize_text_field($request->get_param( 'restriction' )) ,
            ];

            if ($id){
                foreach ($update as $acf_field => $value){
                    if ($acf_field!='restrictions' && !$value){
                        $value = 'false';
                    }
                    update_field($acf_field, $value, $id);
                }
                update_post_meta($id, 'has_any_change_by_api', true);
                return new WP_REST_Response( 'Fields changed', 200 );

            } else {
                return new \WP_REST_Response('No ID found', 400);
            }
        }
        return new \WP_REST_Response('No info', 400);
    }

    public function get_info_by_id($request){
        $search_id = sanitize_text_field( $request['search_id'] );

        $post = get_post($search_id);

        if (!empty($post)){
            $output = [
                'id'=> $post->ID,
                'name'=> $post->post_title,
                'couple_name'=> get_field('couple',$post->ID) ?? '',
                'plus_guests' => get_field('plus_guests',$post->ID) ?? 0,
            ];
            return new WP_REST_Response( $output, 200 );

        } else {
            return new \WP_REST_Response('No info for that ID', 400);
        }
    }

    public function check_for_change($request){
        $search_id = sanitize_text_field( $request['search_id'] );
        $post_meta = get_post_meta($search_id, 'has_any_change_by_api', true) ?? false;

        if ($post_meta){
            return new WP_REST_Response(true, 200 );
        }
        return new WP_REST_Response(false, 200 );
    }
}

new SearchApi();