<? $this->beginClip('sidebar') ?>

<div class="g-barTitle">Sider</div>
<div class="g-sidebarNav">
	<ul>
		<li><?= CHtml::link('Vis alle', array('index')) ?></li>
		<? if (Yii::app()->user->checkAccess('admin')): ?>
			<li><?= CHtml::link('Lag ny', array('create')) ?></li>
			<li><?= CHtml::link('Admin', array('admin')) ?></li>
		<? endif; ?>
	</ul>
</div>
<? $this->endClip() ?>