
<items>
	<? foreach ($data as $post): ?>
	<div><?=CHtml::link($post['title'],array($post['path'])); ?>	</div>
	<? endforeach; ?>
</items>