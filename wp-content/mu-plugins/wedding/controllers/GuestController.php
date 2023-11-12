<?php

namespace DelfiNico\Guest;

class GuestController {
    protected $routes;
    private mixed $guests_model;

    public function __construct($guests_model) {
        $this->guests_model = $guests_model;
    }

    public function search_guest($request): \WP_REST_Response
    {
        $id = sanitize_text_field($_GET['id'] ?? '');
        $search_string = sanitize_text_field($_GET['search_string'] ?? '');


        if (!empty($id)){
            $info = $this->guests_model->search_by_id($id);
            if (!empty($info)){
                return new \WP_REST_Response( $info, 200 );
            } else {
                return new \WP_REST_Response('No info for that ID.', 401);
            }
        }

        if (!empty($search_string)){
            $info = $this->guests_model->search_by_title($search_string);
            if (!empty($info)){
                return new \WP_REST_Response( $info, 200 );
            } else {
                return new \WP_REST_Response('No info for that ID.', 401);
            }
        }

        return new \WP_REST_Response('Error', 40);
    }

    public function update_guest($request=NULL): \WP_REST_Response
    {
        $data = [
            'assistance_guest'      =>  sanitize_text_field($request->get_param('main')),
            'assistance_couple'     =>  sanitize_text_field($request->get_param('couple')),
            'assistance_plus_one'   =>  sanitize_text_field($request->get_param('plus_guest')) ,
            'restrictions'          =>  sanitize_text_field($request->get_param('restriction')) ,
        ];

        $request = $this->guests_model->upload_guest_info($data);
        if ($request){
            return new \WP_REST_Response( 'Fields changed', 200 );
        } else {
            return new \WP_REST_Response('No ID found', 400);
        }
    }

    public function check_for_change($request){
        $search_id = sanitize_text_field( $request['search_id'] );
        $post_meta = get_post_meta($search_id, 'has_any_change_by_api', true) ?? false;

        if ($post_meta){
            return new \WP_REST_Response(true, 200 );
        }
        return new \WP_REST_Response(false, 200 );
    }
}