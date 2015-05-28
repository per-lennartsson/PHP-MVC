<div class="tags">
<h1>Populäratse taggarna</h1>
<?php if (is_array($tags)) : ?>
<?php foreach ($tags as $tag) : ?>
<h2><a href="<?=$this->url->create( 'tag/tag/'.$tag->nameTag )?>"> #<?=$tag->nameTag?> </a></h2>
<?php endforeach; ?>
<?php endif; ?>
</div>
