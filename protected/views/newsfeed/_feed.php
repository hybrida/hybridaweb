<div id="newsfeed">
<? if (empty($models)): ?>
    <p>
        Ingen flere nyheter
    </p>
    <? return; ?>
<? endif; ?>

<? foreach ($models as $model): ?>
    <div class="element">
		<div class="header-wrapper">
			<div class="header-title">
				<h1><?= CHtml::link($model->title, $model->viewUrl) ?></h1>
			</div>
        </div>
		<div class="text-content">
			<? if ($model->imageId):?>
				<?= Image::tag($model->imageId, 'frontpage') ?>
			<? endif ?>
            <?= $model->ingress ?>
			<? if ($model->author): ?>
				<div class="author">
				Skrevet av <?= CHtml::link($model->author->fullName, $model->author->viewUrl) ?> den <?= Html::dateToString($model->timestamp, 'medium') ?>
				</div>
			<? endif ?>
		</div>
    </div>
<? endforeach ?>
</div>