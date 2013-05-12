<?php
$this->pageTitle = "Nyhetsstrøm";
$this->layout = "//layouts/newsfeed";

$this->beginClip('sidebar'); ?>
	<? if ($hasPublishAccess): ?>
		<fieldset class="g-adminSet">
			<legend>Admin</legend>
			<?=
			CHtml::link("Publiser", array("news/create"), array(
				'class' => 'g-button',
			))
			?>
			<?=
			CHtml::link("Nyheter", array("admin/news"), array(
				'class' => 'g-button',
			))
			?>
			<?=
			CHtml::link("Artikler", array("admin/articles"), array(
				'class' => 'g-button'
			))
			?>
            <?=
            CHtml::link("Statistikk", array("admin/stats"), array(
                'class' => 'g-button'
            ))
            ?>
		</fieldset>
	<? endif ?>
<?
$this->widget('application.components.widgets.ActivitiesFeed');
Yii::import('jobAnnouncement.widgets.JobAnnouncementFeed');
$this->widget('JobAnnouncementFeed');
$this->endClip();
?>
<div class="newsfeedIndex">
<div class="feeds">
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>

</div>
<?=CHtml::button('Vis flere', array(
	'class' => 'g-button',
	'style' => 'display: block; width: 100%;',
	'id' => 'fetchNews',
))?>

<?php

$ajaxFeedUrl = $this->createUrl("feedAjax", array(
	'offset' => ''
));

?>
<script language="javascript">
	require(['newsfeed']);
	var data = {
		count: <?= $index ?>,
		ajaxFeedUrl: '<?= $ajaxFeedUrl ?>',
		ajaxButtonSelector: '#fetchNews',
		feedContentSelector: '.feeds',
		limit: <?= $limit ?>
	};
</script>
</div>