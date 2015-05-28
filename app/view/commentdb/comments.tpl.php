<hr>

<h2>Comments</h2>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $comment) : ?>
<h4>Comment #<?=$comment->id?></a> </h4>
<p><?=$comment->name?></p>
<p><?=$comment->content?></p>
<p><?=$comment->timestamp?></p>

<td><a class='td' href='<?=$this->url->create( 'commentdb/edit/'.$comment->id )?>'>Editera</a></td>
<td><a href='<?=$this->url->create( 'commentdb/remove/'.$comment->id )?>'>Radera</a></td>
<?php endforeach; ?>
</div>
<?php endif; ?>
