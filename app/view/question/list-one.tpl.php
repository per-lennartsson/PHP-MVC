<?php var_dump($questions);?>

<?php if (is_array($questions)) : ?>
<?php foreach ($questions as $question) : ?>
<h4>Fråga #<?=$question->id?></a> </h4>
<p><?=$question->name?></p>
<p><?=$question->nameTag?></p>
<p><?=$question->content?></p>
<p><?=$question->timestamp?></p>
<?php endforeach; ?>
<?php endif; ?>
