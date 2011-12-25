<h1>NewsFeed</h1>

<?=CHtml::link("Publiser",array("news/create"))?>

<div class="feed">
	<? foreach ($models as $model): ?>
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
				<?= substr($model->content, 0,15000) ?>
				<div class="date">Dato: <?= $model->timestamp ?></div>
				<div class="author"><a href="#">Link til skribent</a></div>
			</div>
		</div>
	<? endforeach ?>
</div>
