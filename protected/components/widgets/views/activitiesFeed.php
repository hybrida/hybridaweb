
<div class='barTitle'>Arrangementer</div>

<div class="barText">
	<? foreach ($models as $model): ?>
		<?= CHtml::link($model->title, $model->viewUrl) ?> <br>
	<? endforeach ?>

	<? if (empty($models)): ?>
		Det finnes ingen kommende arrangementer
	<? endif ?>
</div>