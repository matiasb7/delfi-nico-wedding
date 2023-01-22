<?php
$fields = get_field('program');
$text = $fields['text'] ?? '';
?>

<div class="tab program_tab wrapper">
    <?php if($text): ?>
        <div class="text-container">
            <?php echo $text ; ?>
        </div>
    <?php endif; ?>
</div>
