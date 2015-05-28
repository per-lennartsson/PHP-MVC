<?php if (is_array($questions)) : ?>
<?php foreach ($questions as $question) : ?>
<div class="wrap">
<h2><a href="<?=$this->url->create( 'question/id/'.$question->id )?>"> <?=$question->title?> </a></h2>
<p><?=$question->text?></p>

<p>Skapad: <?=$question->timestamp?> av <a href="<?=$this->url->create( 'users/id/'.$question->acronymId )?>"> <?=$question->acronym?> </a></p>
<?php
    $tags = explode(",", $question->tags);
    foreach ($tags as $tag) : ?>

    <a href="<?=$this->url->create( 'tag/tag/'.$tag )?>">#<?=$tag?></a>

<?php endforeach;?>
</div>
<?php endforeach; ?>
<?php endif; ?>
