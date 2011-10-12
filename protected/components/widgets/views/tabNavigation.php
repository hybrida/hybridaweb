
<items><? /*
	<? foreach ($data as $post): ?>
	<div><?=CHtml::link('title',array('/site/index')); ?>	</div>
	<? endforeach; ?>
 */ ?>
	
	<div><?=CHtml::link('Log inn',array('/site/login')); ?> </div>
	<div><?=CHtml::link('Log ut',array('/site/logout')); ?>	</div>
	<div><?=CHtml::link('Gruppe',array('/group')); ?>	</div>
	<div><?=CHtml::link('debug',array('/site/debug')); ?>	</div>


	
</items>