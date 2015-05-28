<h1><?=$title?></h1>
<?php
    if (isset($flash)) {
        echo $flash;
    }
?>
<?php foreach ($users as $user) : ?>
    <div class="wrap box">
        <h2><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->acronym?></a></h2>
    </div>
<?php endforeach; ?>
