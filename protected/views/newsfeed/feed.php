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

			<?= CHtml::link("Forsidebilde", array("frontpageBanner/index"), array(
					'class' => 'g-button'
			)) ?>

		</fieldset>
	<? endif ?>

    <div class='g-barTitle'>Kontortider</div>
    <div class="g-sidebarNav">
        <div class="officeHours">
            <p>
                <!-- <div class="title">Styret:</div> Torsdag 10:15-12:00<br/>
                Hybridakontoret, Gamle kjemiiiii
                <br/><br/>-->
                <div class="title">PTV:</div> Torsdag 12.00-14.00<br/>
                Studentrådskontoret over <br/>kiosken på stripa
            </p>
        </div>
    </div>
	<?
	$this->widget('application.components.widgets.ActivitiesFeed');?>


    <? if(!(Yii::app()->user->isGuest)){?>
        <div class='g-barTitle'><?= CHtml::link("Nyeste #hybridantnu", array("instafeed/index")); ?></div>
        <div class="instafeed">
            <div id="instafeed-front"></div>
        </div>
    <? }?>

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

<script type="text/template" id="instafeed-front-template">
    <div class="front">
        <a href="<?=$this->createUrl("instafeed/index")?>">
            <img src="{{image}}" />
        </a>
            <a href="{{link}}">
                <i class="icon-comment"></i>  {{comments}}
                <i class="icon-heart"></i>   {{likes}}
        </a>
    </div>
</script>

<script type="text/javascript">
    require(['instafeed'], function(insta) {
        var feed = new insta.Instafeed({
            target: 'instafeed-front',
            get: 'tagged',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: $('#instafeed-front-template').html(),
            limit: 2
        });
        feed.run();
    });
</script>
