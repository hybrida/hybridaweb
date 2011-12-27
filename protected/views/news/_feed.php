<?if (empty ($models)):?>
<p>
	Ingen flere nyheter
</p>
<? return; ?>
<? endif; ?>

<? $gk = new GateKeeper ?>
<? foreach ($models as $model): ?>
	<?
		if (!$gk->hasAccess('news', $model->id))
			continue;
	?>

	<div class="contentItem">
		<div class="blueBox">
			<div class="blueBoxItem"></div>
		</div>
		<div class="topBar">
			<div class="topBarItem"></div>
			<h1><?= $model->title ?></h1>
		</div>
		<div class="articleContent">
			<div align="right">
				<? $url = $this->createUrl("news/edit", array("id" => $model->id)); ?>
				<a href="<?= $url ?>">
					<img height='20' src="/images/icons/edit.png"/>
				</a>
			</div>
			<?= $model->content ?>
			<div class="date">Dato: <?= $model->timestamp ?></div>
			<div class="author"><?=
				CHtml::link($model->authorName, array("profile", "id" => $model->author))
			?></div>
		</div>
	</div>
<? endforeach ?>