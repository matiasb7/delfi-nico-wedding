<?php

$fields = get_field('travel');
$hero_img = $fields['image'] ?? false;
$is_hidden = $args['hidden'] ?? false;

$titles = [];
$items = [];

foreach ($fields as $key => $array){
    if(!str_contains($key, 'item')) {
        continue;
    }
    $titles[] = $array['title'];
    $items[$array['title']] = $array;
}

?>
<section role='tabpanel' class="tab travel_tab wrapper" style="<?php echo $is_hidden ? 'display:none' : '' ;?>">
    <?php if($hero_img): ?>
        <img class="hero-img" src="<?php echo $hero_img['url']; ?>" alt="BG">
    <?php endif; ?>

    <div class="titles">
        <?php foreach ($titles as $title): ?>
            <a href="#<?php echo $title; ?>" class="title"><?php echo $title; ?></a>
        <?php endforeach; ?>
    </div>

    <div class="travel-items">
    <?php
    $image_side_left = true;
    foreach ($items as $title => $item):
        $order = $image_side_left ? 0 : 1 ;
        ?>
        <div class="travel-item" id="<?php echo $title; ?>">
            <div class="image">
                <?php if(!empty($item['image'])):
                    $url = $item['image']['url'] ?? false;
                    if (!$url){
                        $img_post = get_post($item['image']);
                        $url = wp_get_attachment_url($img_post->ID);
                    }
                    ?>
                    <img src="<?php echo $url ?>" alt="">
                <?php endif; ?>
            </div>

            <div class="item-content">
                <?php if(!empty($item['barcelona']) || !empty($item['costa_brava'])): ?>
                    <div class="text">

                        <?php if(!empty($item['barcelona'])): ?>
                            <div class="left">
                               <?php echo $item['barcelona'] ; ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($item['costa_brava'])): ?>
                            <div class="right">
                                <?php echo $item['costa_brava'] ; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if(!empty($item['cta'])): ?>
                    <a target="<?php echo $item['cta']['target']; ?>" href="<?php echo $item['cta']['url']; ?>"><?php echo $item['cta']['title']; ?></a>
                <?php endif; ?>

            </div>
        </div>
    <?php
    $image_side_left = !$image_side_left;
    endforeach; ?>
    </div>
</section>
