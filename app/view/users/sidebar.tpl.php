
<h1><?=$user["title"]?></h1>
<?php if(is_array($user)) : ?>
    <?php
    $email = $user["user"]->email;
    $default = "http://www.student.bth.se/~pele14/phpmvc/kmom10/webroot/img/anax.png";
    $size = 250;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

    ?>
        <img src="<?php echo $grav_url; ?>" alt="userimage" />
        <p>Acronym: <?=$user["user"]->acronym?></p>
        <p>Namn: <?=$user["user"]->name?></p>
        <p>E-post: <?=$user["user"]->email?></p>
        <p>Om användaren: <?=$user["user"]->about?></p>
        <p>Medlem sedan <?=$user["user"]->created?></p
<?php endif; ?>
