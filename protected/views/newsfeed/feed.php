<?php
$this->pageTitle = "Nyhetsstrøm";
$this->layout = "//layouts/newsfeed";
?>

<?php
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
	$this->widget('application.components.widgets.ActivitiesFeed');?>
    <div class='g-barTitle'>Hybdrida Feed</div>
    <div id="instafeedfront"></div> 
	<?Yii::import('jobAnnouncement.widgets.JobAnnouncementFeed');
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


<script type="text/javascript">
    require(['instafeed'], function(insta) {
        var feed = new insta.Instafeed({
            target: 'instafeedfront',
            get: 'tagged',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: '<div id="Instafeedfront>"<a href="{{link}}"><img src="{{image}}" /></a></div>',
            limit: 2 
        });
        feed.run();
    });
</script>