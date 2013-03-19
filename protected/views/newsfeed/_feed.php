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
			<div class="header-date">

			</div>
		</div>
		<div class="text-content">
			<? if ($model->imageId): ?>
				<a href="<?= $model->viewUrl ?>">
					<?= Image::tag($model->imageId, 'frontpage') ?>
				</a>
			<? endif ?>
			<?= $model->ingress ?>
			<? if ($model->author): ?>
				<div class="author">
					<?= CHtml::link($model->author->fullName, $model->author->viewUrl) ?>
					den
					<span class="date">
						<?= Html::dateToString($model->timestamp, 'mediumlong') ?>
					</span>
				</div>
			<? else: ?>
				<div class="author">
					Hybrida
					den
					<span class="date">
						<?= Html::dateToString($model->timestamp, 'mediumlong') ?>
					</span>
				</div>
			<? endif?>

		</div>
	</div>
<? endforeach ?>
