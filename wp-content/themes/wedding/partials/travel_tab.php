<?php

$fields = get_field('travel');
$text = $fields['text'] ?? false;
$img = $fields['image'] ?? false;

?>
<div class="tab wrapper">
    <?php if ($text):
        echo $text;
    endif; ?>

    <?php if($img): ?>
        <img src="<?php echo $img['url'] ;?>" alt="<?php echo $img['alt'] ;?>">
    <?php endif; ?>
</div>
