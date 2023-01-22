<?php
/**
 * Template Name: Homepage
 **/


//echo '<pre>';
//$fields = get_fields();
//print_r($fields);

get_header(); ?>

<div class="header wrapper">
    <div class="mobile-menu-select">
        <?php // Code here comes from JS ?>
        <div class="arrow">
            <?= file_get_contents(get_template_directory() . "/svgs/arrow-down.svg") ?>
        </div>
    </div>
    <div class="menu">
        <div class="current-tab menu-item">Home</div>
        <div class="menu-item">Program</div>
        <div class="menu-item">Travel</div>
        <div class="menu-item">Registry</div>
        <div class="menu-item">Location</div>
    </div>
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
<!--<form action="javascript:void(0)">
<label for="guest">Enter your name here:</label>
<input type="text" id="guest" name="guest" required>
<input id="guest-submit-button" type="submit" value="Submit">
<div class="response"></div>
</form>-->
</body>

<?php
wp_footer();
get_footer();
