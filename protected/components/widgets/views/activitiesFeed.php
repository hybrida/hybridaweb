
<div class='barTitle'>Kommende aktiviteter</div>

<div class="barText">
	<? foreach ($models as $model): ?>
		<?= CHtml::link($model->title, $model->viewUrl) ?> <br>
	<? endforeach ?>
</div>