<?php
/**
 * Template Name: Guests list
 **/
get_header(); ?>
<header class="rsvp-header wrapper">
    <h2>RSVP</h2>
    <a href="<?php echo get_home_url(); ?>"><?php echo file_get_contents(get_template_directory() . "/svgs/close.svg") ?></a>
</header>
<body class="wrapper">
    <div class="rsvp_text">
        <h3>Delfi & Nico's Wedding</h3>
        <form id="search_guest" action="javascript:void(0)">
            <label class="guest-label" for="guest">Enter your name here:</label>
            <input type="text" id="guest" name="guest" required>
            <input id="guest-submit-button" type="submit" value="Find your Invitation">
            <div class="response"></div>
        </form>
    </div>
</body>
<?php
wp_footer();
get_footer();