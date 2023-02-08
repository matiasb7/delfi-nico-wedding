<?php

$fields = get_field('faq');
$items = [];

foreach ($fields as $group => $array_info) {
    if (!empty($array_info)){
        $items[] =[
            'question'=>$array_info['question'] ,
            'answer'=>$array_info['answer'] ,
        ];
    }
}
?>


<div class="tab faqs_tab wrapper">
    <?php if ($fields && is_array($fields)): ?>
        <?php foreach ($items as $item):
            $question = $item['question'] ?? '';
            $answer = $item['answer'] ?? '';
            ?>
            <?php if (!empty($question) && !empty($answer)): ?>
                <sl-details class="text-small" summary="<?php echo $question; ?>">
                    <sl-icon name="plus-lg" slot="expand-icon"></sl-icon>
                    <sl-icon name="dash-lg" slot="collapse-icon"></sl-icon>
                    <p><?php echo $answer; ?></p>
                </sl-details>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php
