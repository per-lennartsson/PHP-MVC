<h2>Edit comment: <?=$name?></h2>

<div class='comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($pageName)?>">
        <input type=hidden name="pageName" value="<?=$pageName?>">
        <input type=hidden name="key"      value="<?=$id?>"
        <fieldset>
        <legend>Leave a comment</legend>
        <p><label>Comment:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p><label>Name:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Homepage:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
        <p><label>Email:<br/><input type='email' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
            <input type='submit' name='doSave' value='Comment' onClick="this.form.action = '<?=$this->url->create('comment/save')?>'"/>
            <input type='submit' name='doRemove' value='Remove' onClick="this.form.action = '<?=$this->url->create('comment/remove')?>'"/>
        </p>
        </fieldset>
    </form>
</div>
