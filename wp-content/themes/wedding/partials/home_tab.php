<?php
$fields = get_field('home'); ?>
<section role='tabpanel' class="tab home_tab wrapper">
    <?php if(!empty($fields['title'])): ?>
        <h1 class="main-title"><?php echo $fields['title'] ?></h1>
    <?php endif; ?>

    <?php if(!empty($fields['hero_image'])): ?>
        <img class="home-img" src="<?php echo $fields['hero_image']['url'] ?>" alt="<?php echo $fields['hero_image']['alt'] ?>">
    <?php endif; ?>

    <div class="info-container">
        <?php if(!empty($fields['date'])): ?>
            <h2><?php echo $fields['date'] ?></h2>
        <?php endif; ?>

        <?php if(!empty($fields['location'])): ?>
            <h2><?php echo $fields['location'] ?></h2>
        <?php endif; ?>
    </div>

    <?php if(!empty($fields['text'])): ?>
        <div class="more-info">
            <?php echo $fields['text']; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($fields['registration_button_text'])): ?>
        <div class="registration">
            <a href="<?php echo get_home_url() . '/rsvp' ?> "><?php echo $fields['registration_button_text']; ?></a>
        </div>
    <?php endif; ?>
</section>