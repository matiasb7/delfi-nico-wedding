<?php
/**
 * Template Name: Homepage
 **/

get_header(); ?>

<body>
<div>
    <?php get_template_part('partials/home_tab') ?>
    <?php get_template_part('partials/program_tab', null, ['hidden' => true]) ?>
    <?php get_template_part('partials/travel_tab', null, ['hidden' => true]) ?>
    <?php get_template_part('partials/registry_tab',  null, ['hidden' => true]) ?>
</div>
</body>

<?php
wp_footer();
get_footer();
