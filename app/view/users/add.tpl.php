<?php
    if($authenticate == false)
    {
        if (isset($content)) {
            echo $content;
        }
    }
    else
    {
        $url =$this->url->create( 'authenticate/logout');
        echo "Du måste vara  <a href=".$url.">Utloggad</a> för att registerar en ny användare";
    }
?>
