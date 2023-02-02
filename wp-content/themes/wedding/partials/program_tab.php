<?php
$fields = get_field('program');
$items = $fields['items'] ?? [];
$text = $fields['text'] ?? '';
$end_text = $fields['end_text'] ?? '';

/*echo '<pre>';
print_r($items);
die();*/
?>

<div class="tab program_tab wrapper">
    <img class="bg-image-left" src="<?php echo get_template_directory_uri() . '/imgs/program-crop-bg.jpeg' ?>" alt="BG">
    <img class="bg-image-right" src="<?php echo get_template_directory_uri() . '/imgs/program-crop-bg.jpeg' ?>" alt="BG">

    <?php if($text): ?>
        <div class="text-container">
            <?php echo $text ; ?>
        </div>
    <?php endif; ?>

    <div class="agenda">
        <?php
        $icon_right = true;

        foreach($items as $item):
            $icon_order = $icon_right ? 1 : 0 ;
            ?>
            <?php if (!empty( $item['text']) && !empty( $item['icon'])):

                $url = $item['icon']['url'] ?? false;
                if (!$url){
                    $img_post = get_post($item['icon']);
                    $url = wp_get_attachment_url($img_post->ID);
                }

            ?>
                <div class="item">
                    <div class="line" style="left:<?php echo $icon_right ? 'calc(50% - 7px);' : 'calc(50% + 7px);' ; ?>"></div>

                    <div class="content" style="order:<?php echo $icon_order; ?>">
                        <div class="item_text">
                            <p><?php echo $item['text']; ?></p>
                        </div>

                        <div class="hour"><?php echo $item['hour']; ?></div>

                    </div>


                    <div class="item_icon">
                        <img src="<?php echo $url; ?>" alt="icon">
                    </div>

                </div>
            <?php endif;
            $icon_right = !$icon_right;
        endforeach; ?>
    </div>

    <?php if($end_text): ?>
        <div class="end-text">
            <?php echo $end_text;?>
        </div>
    <?php endif; ?>
</div>
