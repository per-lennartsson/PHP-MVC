<h2> #<?=$tag?> </h2>
<h3>Frågor</h3>
<hr>
<?php foreach ($questions as $question) : ?>
<p><a href="<?=$this->url->create( 'question/id/'.$question->id )?>"> <?=$question->title?> </a></p>
<?php endforeach;?>
