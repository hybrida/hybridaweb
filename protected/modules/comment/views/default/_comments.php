<? foreach ($models as $model): ?>
	<p><?= $model->content ?></p>
	<p> Skrevet av: <?= Html::link($model->author->fullName, $model->author->viewUrl) ?></p>
<? endforeach; ?>