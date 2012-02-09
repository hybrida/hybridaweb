
<div class='barTitle'>Kommende aktiviteter</div>

<div class="barText">
	<? foreach ($models as $model): ?>
		<?= CHtml::link($model->title, $model->viewUrl) ?> <br>
	<? endforeach ?>

	<? if (empty($models)): ?>
		Du er ikke påmeldt noen arrangementer i fremtiden.
	<? endif ?>
</div>