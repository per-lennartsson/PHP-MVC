<div class="question">
<h1>Nyaste frågorna</h1>
<?php if (is_array($questions)) : ?>
<?php foreach ($questions as $question) : ?>
<h2><p><a href="<?=$this->url->create( 'question/id/'.$question->id )?>"><?=$question->title?> </a></p></h2>
<?php endforeach; ?>
<?php endif; ?>
</div>
