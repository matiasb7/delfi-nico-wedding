<?php

namespace DelfiNico\Guest;

class GuestModel
{
    public string $name;
    public function __construct($init = false)
    {
        $this->name = 'guests';
        if ($init) {
            add_action('init', [$this, 'register_post'], 0);
        }
    }

    public function search_by_title($search_string): array
    {
        $args = [
            'post_type' => $this->name,
            's' => $search_string,
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];
        $query = new \WP_Query($args);

        if (empty($query->posts)) return [];

        $output = [];
        foreach ($query->posts as $post) {
            $output[] = $this->export_guest_info($post);
        }
        return $output;
    }

    public function search_by_id($search_id): array
    {
        $post = get_post($search_id);
        if (empty($post)) return [];
        return $this->export_guest_info($post);
    }

    public function upload_guest_info($data){
        $id = $data['id'] ?? false;
        if(!$id) return false;

        $update = [
            'assistance_guest'      => $data['main'] ,
            'assistance_couple'     => $data['couple'] ,
            'assistance_plus_one'   => $data['plus_guest'],
            'restrictions'          => $data['restriction'] ,
        ];

        foreach ($update as $acf_field => $value){
            if ($acf_field!='restrictions' && !$value){
                $value = 'false';
            }
            update_field($acf_field, $value, $id);
        }

        update_post_meta($id, 'has_any_change_by_api', true);
        return true;
    }

    public function register_post(): void
    {
        register_post_type(
            $this->name,
            array(
                'labels' => array(
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
                'public' => true,
                'has_archive' => false,
                'menu_icon' => 'dashicons-admin-users',
                'supports' => array('title'),
                'publicly_queryable'  => false,
            )
        );
    }

    private function export_guest_info($post): array
    {
        return [
            'id' => $post->ID,
            'name' => $post->post_title,
            'couple_name' => get_field('couple', $post->ID) ?? '',
            'plus_guests' => get_field('plus_guests', $post->ID) ?? 0,
        ];
    }
}