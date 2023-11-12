<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo get_bloginfo('name'); ?></title>
<?php wp_head(); ?>
</head>

<header class="header wrapper">
    <div class="mobile-menu-select">
        <?php // Code here comes from JS ?>
        <div class="arrow">
            <?= file_get_contents(get_template_directory() . "/svgs/arrow-down.svg") ?>
        </div>
    </div>
<!--    --><?php //wp_nav_menu(array('theme_location' => 'main-nav', 'container' => false, 'fallback_cb' => false, 'menu_class' => 'menu')); ?>
    <div class="menu">
        <div role='tab' class="current-tab menu-item">Home</div>
        <div role='tab' class="menu-item">Program</div>
        <div role='tab' class="menu-item">Things To Do</div>
        <div role='tab' class="menu-item">Gifts</div>
    </div>
</header>

