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

				<? if ($model->parentType == ''): ?>
					<span style="color: red">Nyhet</span>
				<? elseif($model->parentType == 'event' && $model->event->eventCompany): ?>
					<span style="color: blue">Bedpress</span>
				<? elseif($model->parentType == 'event'): ?>
					<span style="color: green">Event</span>
				<? endif ?>
			</div>
		</div>
		<div class="text-content">
			<? if ($model->imageId): ?>
				<a href="<?= $model->viewUrl ?>">
					<?= Image::tag($model->imageId, 'frontpage') ?>
				</a>
			<? endif ?>
			<div class="ingressWrapper">
				<? if ($model->parentType == ''): ?>
					<div class="ingress">
						<?= $model->ingress ?>
					</div>
				<? elseif($model->parentType == 'event' && $model->event->eventCompany): ?>
					<div class="ingress-left">
						<?= $model->ingress ?>
					</div>
					<div class="info">
						Her er det informasjon
						Bedrift: <?= $model->event->eventCompany->bpcID ?>
					</div>
				<? elseif($model->parentType == 'event'): ?>
					<div class="ingress-left">
						<?= $model->ingress ?>
					</div>
					<div class="info">
						Her er det informasjon
						start: <?= $model->event->start ?>
					</div>
				<? endif ?>
			</div>

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
