<?php
$fields = get_field('registry');
$text = $fields['text'] ?? '';
$is_hidden = $args['hidden'] ?? false;
?>

<section role='tabpanel' class="tab registry_tab wrapper" style="<?php echo $is_hidden ? 'display:none' : '' ;?>">
    <?php if($text): ?>
        <div class="text-container">
            <?php echo $text ; ?>
        </div>
    <?php endif; ?>
</section>
