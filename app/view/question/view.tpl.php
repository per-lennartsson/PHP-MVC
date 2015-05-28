<div class="wrap">
<h2><?=$question->title?></h2>
<p><?=$question->text?></p>
<p>Skapad: <?=$question->timestamp?> av <a href="<?=$this->url->create( 'users/id/'.$question->acronymId )?>"> <?=$question->acronym?> </a></p>
<?php
    $tags = explode(",", $question->tags);
    foreach ($tags as $tag) : ?>

    <a href="<?=$this->url->create( 'tag/tag/'.$tag )?>"> #<?=$tag?> </a>

<?php endforeach;?>
</div>
<h3>Kommentarer</h3>
<?php foreach ($commentsQuestions as $comment) : ?>

    <?php
    $counter = 1;
    foreach ($comment as $comment1) : ?>
        <?php if (is_string($comment1->text)) :?>
            <div class="wrap">
                <h3>Kommentar <?=$counter?> </h3>
                <p><?=$comment1->text?></p>
            </div>
        <?php $counter++; endif; ?>
    <?php endforeach; ?>

<?php endforeach; ?>
<a href="<?=$this->url->create( 'comment/q/'.$question->id)?>">Kommentera</a>
<hr>
<h2>Svar</h2>
<?php foreach ($answers as $answer) : ?>

    <?php

    $counter = 1;
     foreach ($answer as $answer1) : ?>
     <div class="wrap">
        <?php if (is_string($answer1->text)) :?>
            <h3>Svar <?=$counter?> </h3>
            <p><?=$answer1->text?></p>
            <?php foreach ($commentsAnswers[$answer1->id] as $comment) : ?>
                <hr>
                <p>Kommentarer</p>
                <?php $count=1; foreach ($comment as $comment1) : ?>
                    <?php if (is_string($comment1->text)) :?>
                        <div class="wrap">
                            <h3>Kommentar <?=$count?> </h3>
                            <p> <?=$comment1->text?></p>
                        </div>
                    <?php endif; ?>
                <?php $count++; endforeach; ?>
            <?php endforeach; ?>
            <a href="<?=$this->url->create( 'comment/a/'.$answer1->id)?>">Kommentera</a>
        <?php $counter++; endif; ?>
    </div>
    <?php endforeach; ?>
<?php endforeach; ?>
<?php
    if($authenticate == true)
    {
        echo $answerForm;
    }
    else
    {
        $url =$this->url->create( 'authenticate/login');
        echo "Du måste <a href=".$url.">Logga in</a> för att svara";
    }


?>
