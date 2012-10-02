
<div class='g-barTitle'><?= Html::link("Utlyste jobber", array("/jobAnnouncement/jobAnnouncement/index")) ?></div>

<div class="g-sidebarNav">
	<ul>
	<? foreach ($models as $model): ?>
		<li><?= CHtml::link($model->title, $model->viewUrl) ?></li>
	<? endforeach ?>

	<? if (empty($models)): ?>
		<li>Det er ingen utlyste jobber</li>
	<? endif ?>
	</ul>
</div>