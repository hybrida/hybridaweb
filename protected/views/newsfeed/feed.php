<?php
$this->pageTitle = "Nyhetsstrøm";
$this->layout = "//layouts/newsfeed";

$this->beginClip('sidebar'); ?>
	<? if ($hasPublishAccess): ?>
	<fieldset class="g-adminSet">
		<legend>Admin</legend>
	<?=	CHtml::link("Publiser", array("news/create"), array(
			'class' => 'g-button',
	))	?>
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
	'class' => 'g-button g-buttonRightSide',
	'id' => 'fetchNews',
))?>

<?php
$ajaxFeedUrl = $this->createUrl("feedAjax", array(
	'offset' => ''));
?>
<script language="javascript">
	var count = <?= $index ?>;
	$("#fetchNews").click(function fetchNews(){
		
		$.ajax({
			success: function(html){
				$(".feeds").append(html);
			},
			type: 'get',
			url: '<?= $ajaxFeedUrl ?>' + count,
			data: {
				index: $(".feeds li").size()
			},
			cache: false,
			dataType: 'html'
		});
		count += <?= $limit ?>;
	});
</script>
</div>