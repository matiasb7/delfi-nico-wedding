<?php
function accelerate_theme_init()
{
    register_nav_menu('main-nav', __('Main Menu'));
}
add_action('init', 'accelerate_theme_init');