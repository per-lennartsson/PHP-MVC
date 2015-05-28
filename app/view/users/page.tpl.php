<div class="users">
<h1>Mest aktiva användarna</h1>
<?php if (is_array($users)) : ?>
<?php foreach ($users as $user) : ?>
<h2><a href="<?=$this->url->create( 'users/id/'.$user->id )?>"> #<?=$user->acronym?> </a></h2>
<?php endforeach; ?>
<?php endif; ?>
</div>
