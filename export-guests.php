<?php
include 'wp-load.php';

$args =[
    'post_type'=>'guests',
    'ṕosts_per_page'=>-1
];

$posts = get_posts($args);

$output= [];
foreach ($posts as $p) {
    $output[$p->post_title] = get_fields($p->ID);
}

file_put_contents('guests.json', json_encode($output));