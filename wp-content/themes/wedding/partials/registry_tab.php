<?php
$fields = get_field('registry');
$text = $fields['text'] ?? '';
?>

<div class="tab registry_tab wrapper">
    <?php if($text): ?>
        <div class="text-container">
            <?php echo $text ; ?>
        </div>
    <?php endif; ?>
</div>
