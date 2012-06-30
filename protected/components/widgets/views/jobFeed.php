
<div class='barTitle'>Utlyste jobber</div>

<div class="barText">
	<? foreach ($models as $model): ?>
		<?= CHtml::link($model->title, $model->viewUrl) ?> <br>
	<? endforeach ?>

	<? if (empty($models)): ?>
		Det er ingen utlyste jobber
	<? endif ?>
</div>