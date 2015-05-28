<h1><?=$title?></h1>


<ul>

    <li><a href='<?=$this->url->create( 'users/list' )?>'>Visa alla</a></li>
    <li><a href='<?=$this->url->create( 'users/add' )?>'>Skapa användare</a></li>
    <li><a href='<?=$this->url->create( 'users/active' )?>'>Visa aktiva användare</a></li>
    <li><a href='<?=$this->url->create( 'users/deactivate' )?>'>Visa deaktiverade användare</a></li>

</ul>
