<?php
    if($authenticate == true)
    {
        if(isset($userAuthenticate))
        {
            if($userAuthenticate == $user)
            {
                if (isset($content)) {
                    echo $content;
                }
            }
        }
    }
    else
    {
        $url =$this->url->create( 'authenticate/login');
        echo "Du måste <a href=".$url.">Logga in</a> för att redigera din profil";
    }
?>
