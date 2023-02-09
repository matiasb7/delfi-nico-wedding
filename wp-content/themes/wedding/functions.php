<?php
function enqueue_custom_js() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap', false );
    wp_enqueue_style( 'google-fonts-ooh', 'https://fonts.googleapis.com/css2?family=WindSong:wght@400;500&display=swap', false );

    wp_register_script( 'app-js', get_template_directory_uri() . '/app.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'app-js' );

    wp_register_script( 'animations-js', get_template_directory_uri() . '/animations.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'animations-js' );

    wp_register_script( 'formAnimations-js', get_template_directory_uri() . '/formInteractions.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'formAnimations-js' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_js' );


add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4 );

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


add_action('admin_init', function () {
// Redirect any user trying to access comments page
global $pagenow;
if ($pagenow === 'edit-comments.php') {
    wp_safe_redirect(admin_url());
    exit;
}
// Remove comments metabox from dashboard
remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
// Disable support for comments and trackbacks in post types
foreach (get_post_types() as $post_type) {
    if (post_type_supports($post_type, 'comments')) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
    }
}
});
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});
