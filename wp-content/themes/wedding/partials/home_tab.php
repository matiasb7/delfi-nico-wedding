<?php

$fields = get_field('home');

$title = $fields['title'] ?? '';
$image = $fields['hero_image'] ?? '';
$date = $fields['date'] ?? '';
$location = $fields['location'] ?? '';
$text = $fields['text'] ?? '';
$registration_button_text = $fields['registration_button_text'] ?? ''; ?>

<div class="tab home_tab wrapper">
<!--  Actions Test  -->
    <?php if($title): ?>
        <h1 class="main-title"><?php echo $title ?></h1>
    <?php endif; ?>

    <?php if($image): ?>
        <img class="home-img" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
    <?php endif; ?>

    <?php if($date || $location): ?>
    <div class="info-container">
        <?php if($date): ?>
            <h2><?php echo $date ?></h2>
        <?php endif; ?>

        <?php if($date): ?>
            <h2><?php echo $location ?></h2>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if($text): ?>
        <div class="more-info">
            <?php echo $text; ?>
        </div>
    <?php endif; ?>

    <?php if($registration_button_text): ?>
    <div class="registration">
        <a href="<?php echo get_home_url() . '/rsvp' ?> "><?php echo $registration_button_text; ?></a>
    </div>
    <?php endif; ?>
</div>