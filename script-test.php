<?php
include "wp-load.php";

echo 'aa';
$a = get_posts([
    'post_type'=>'guests',
    'posts_per_page'=>-1
]);
print_r($a);