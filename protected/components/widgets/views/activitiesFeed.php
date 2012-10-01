
<div class='g-barTitle'>Arrangementer</div>
<div class="g-sidebarNav">
	<ul>
		<? foreach ($models as $model): ?>
			<li>
				<?= CHtml::link($model->title, $model->viewUrl) ?>
			</li>
		<? endforeach ?>

		<? if (empty($models)): ?>
			<li>Det finnes ingen kommende arrangementer</li>
		<? endif ?>
	</ul>
</div>