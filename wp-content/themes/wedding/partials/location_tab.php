<?php
$fields = get_field('location');
$map_embed = $fields['google_maps'] ?? '';
$text = $fields['text'] ?? '';
?>

<div class="tab location_tab wrapper">
    <?php if($text): ?>
        <div class="text-container">
            <?php echo $text ; ?>
        </div>
    <?php endif; ?>

    <?php if($map_embed): ?>
        <div class="map">
            <?php echo $map_embed ; ?>
        </div>
    <?php endif; ?>
</div>
