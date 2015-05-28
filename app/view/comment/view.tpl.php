<h2>Fråga/Svar</h2>
<?php if(isset($answer->title)){
    echo("<p>".$answer->title."</p>");
}
?>
<?=$answer->text?>
<hr>
<h3>Tidigare kommentarer</h3>
<?php foreach ($comments as $comment) : ?>
<p> <?= $comment->text?></p>
<?php endforeach; ?>
<?php
    if($authenticate == true)
    {
        echo $answerForm;
    }
    else
    {
        $url =$this->url->create( 'authenticate/login');
        echo "Du måste <a href=".$url.">Logga in</a> för att Kommentera";
    }
?>
