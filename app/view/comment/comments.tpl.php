<hr>

<h2>Comments</h2>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
<h4>Comment #<?=$id?></a> </h4>
<p><?=$comment["name"], ",  ",  date("Y-m-d H:i:s", $comment["timestamp"])?></p>
<p><?=$comment["content"]?></p>

<form method=post>
    <input type=hidden name="redirect" value="<?=$this->url->create($comment["pageName"])?>">
    <input type=hidden name="key"      value="<?=$id?>">
    <input type=hidden name="pageName" value="<?=$comment["pageName"]?>">
    <fieldset>
    <p class=buttons>
        <input type='submit' name='doEdit' value='Edit' onClick="this.form.action = '<?=$this->url->create('comment/edit')?>'"/>
        <input type='submit' name='doRemove' value='Remove' onClick="this.form.action = '<?=$this->url->create('comment/remove')?>'"/>
    </p>
    </fieldset>
</form>
<?php endforeach; ?>
</div>
<?php endif; ?>
