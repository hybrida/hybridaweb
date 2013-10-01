<?php
$this->pageTitle = "Nyhetsstrøm";
$this->layout = "//layouts/newsfeed";

$this->beginClip('sidebar'); ?>
	<? if ($hasPublishAccess): ?>
		<fieldset class="g-adminSet">
			<legend>Admin</legend>

			<?= CHtml::link("Publiser", array("news/create"), array(
				'class' => 'g-button',
			)) ?>

			<?= CHtml::link("Nyheter", array("admin/news"), array(
				'class' => 'g-button',
			)) ?>

			<?= CHtml::link("Artikler", array("admin/articles"), array(
				'class' => 'g-button'
			)) ?>

			<?= CHtml::link("Statistikk", array("admin/stats"), array(
				'class' => 'g-button'
			)) ?>

		</fieldset>
	<? endif ?>
	<?
	$this->widget('application.components.widgets.ActivitiesFeed');
	Yii::import('jobAnnouncement.widgets.JobAnnouncementFeed');
	$this->widget('JobAnnouncementFeed');
$this->endClip();
?>
<div class="newsfeedIndex">
	<div class="feeds"></div>

	<?=CHtml::button('Vis flere', array(
		'class' => 'g-button',
		'style' => 'display: block; width: 100%;',
		'id' => 'fetchNews',
	))?>
</div>


<script type="text/json" id="newsfeed-data"><?= $jsonFeed ?></script>

<?php

$ajaxFeedUrl = $this->createUrl("feedAjax", array(
	'offset' => ''
));

	$path = Yii::app()->basePath . '/views/newsfeed/templates/';
	$pubpath = Yii::app()->getAssetManager()->publish($path);
?>

<script language="javascript">
	require(['newsfeed'], function(newsfeed) {
		var view = new newsfeed.NewsFeedView({
			'templatePath': '<?= $pubpath ?>',
			'feedContent': $('.feeds'),
			'jsonData': $("#newsfeed-data").html(),
			'ajaxButton': $("#fetchNews")
		});

		view.load();
	});
</script>
