<?php
/**
 * Template Name: Homepage
 **/

get_header(); ?>

<body>
<label for="guest">Enter your name here:</label>
<input type="text" id="guest" name="guest" required>
<button id="guest-submit-button" type="submit">Submit</button>

</body>

<?php
wp_footer();
get_footer();
