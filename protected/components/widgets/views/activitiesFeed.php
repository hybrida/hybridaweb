
<div class='g-barTitle'>Arrangementer</div>

<div class="g-barText">
	<? foreach ($models as $model): ?>
		<?= CHtml::link($model->title, $model->viewUrl) ?> <br>
	<? endforeach ?>

	<? if (empty($models)): ?>
		Det finnes ingen kommende arrangementer
	<? endif ?>
</div>