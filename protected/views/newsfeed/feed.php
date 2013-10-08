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

<div class='g-barTitle'>Kontortider</div>
<div class="g-sidebarNav">
	<ul>
	SPR: Tirsdag 12.15-14.00
	Studentrådskontoret over kiosken på stripa
	</ul>
</div>
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
		'style' => 'display: none; width: 100%;',
		'id' => 'fetchNews',
	))?>
</div>


<?php
	$path = Yii::app()->basePath . '/views/newsfeed/templates/';
	$pubpath = Yii::app()->getAssetManager()->publish($path);
	$jsonpath = "newsfeed/FeedJSON?minTimestamp=0&minWeight=-10000&limit=0";
?>

<script language="javascript">
	require(['newsfeed'], function(newsfeed) {
		var view = new newsfeed.NewsFeedView({
			'templatePath': '<?= $pubpath ?>',
			'feedContent': $('.feeds'),
			'jsonUrl': '<?= $jsonpath ?>',
			'ajaxButton': $("#fetchNews")
		});

		view.load();
	});
</script>
