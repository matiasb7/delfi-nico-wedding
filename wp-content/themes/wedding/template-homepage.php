<?php
/**
 * Template Name: Homepage
 **/
global $wp;
$current_url = home_url( $wp->request );
get_header(); ?>

<div class="header wrapper">
    <div class="mobile-menu-select">
        <?php // Code here comes from JS ?>
        <div class="arrow">
            <?= file_get_contents(get_template_directory() . "/svgs/arrow-down.svg") ?>
        </div>
    </div>
    <?php if($current_url == get_home_url() . "/es" ): ?>
        <div class="menu">
            <div class="current-tab menu-item">Home</div>
            <div class="menu-item">Programa</div>
            <div class="menu-item">Qué hacer</div>
            <div class="menu-item">Regalos</div>
            <div class="menu-item">Ubicación</div>
            <a class="menu-item" style="font-size: 22px" href="<?php echo get_home_url() . "/rsvp" ; ?>">RSVP</a>
        </div>
    <?php else: ?>
        <div class="menu">
            <div class="current-tab menu-item">Home</div>
            <div class="menu-item">Program</div>
            <div class="menu-item">Things To Do</div>
            <div class="menu-item">Registry</div>
            <div class="menu-item">Location</div>
            <a class="menu-item" href="<?php echo get_home_url() . "/rsvp" ; ?>">RSVP</a>
        </div>
    <?php endif; ?>
    <div class="language">
        <a href="<?php echo get_home_url() ; ?>">EN</a>
        <a href="<?php echo get_home_url() . "/es" ; ?>">ES</a>
    </div>
</div>

<body>
<?php get_template_part('partials/home_tab') ?>
<?php get_template_part('partials/program_tab') ?>
<?php get_template_part('partials/travel_tab') ?>
<?php get_template_part('partials/registry_tab') ?>
<?php get_template_part('partials/location_tab') ?>
<?php get_template_part('partials/faqs_tab') ?>
</body>

<?php
wp_footer();
get_footer();
