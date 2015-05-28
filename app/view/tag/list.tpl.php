<h2>Alla Taggar</h2>

<hr>
<?php if (is_array($tags)) : ?>
<?php foreach ($tags as $tag) : ?>
<div class="wrap box">
<h2><a href="<?=$this->url->create( 'tag/tag/'.$tag->nameTag )?>"> #<?=$tag->nameTag?> </a></h2>
</div>
<?php endforeach; ?>
<?php endif; ?>
