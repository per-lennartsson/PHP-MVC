<h1>Frågor från användaren</h1>
<hr>
<?php if(is_array($questions)) : ?>
<?php foreach ($questions as $question) : ?>
<div class="wrap">
<h3><a href="<?=$this->url->create( 'question/id/'.$question->id )?>"> <?=$question->title?> </a></h3>
</div>
<?php endforeach; ?>
<?php endif; ?>

<h1>Svar från användaren</h1>
<hr>
<?php if(is_array($answers)) : ?>
<?php foreach ($answers as $answer) : ?>
<div class="wrap">
<h3><a href="<?=$this->url->create( 'question/id/'.$answer->questionId )?>"> <?=$answer->text?> </a></h3>
</div>
<?php endforeach; ?>
<?php endif; ?>

<h1>kommentarer från användaren</h1>
<hr>
<?php if(is_array($comments)) : ?>
<?php foreach ($comments as $comment) : ?>
<div class="wrap">
<h3><a href="<?=$this->url->create( 'question/id/'.$comment->questionId )?>"> <?=$comment->text?> </a></h3>
</div>
<?php endforeach; ?>
<?php endif; ?>
