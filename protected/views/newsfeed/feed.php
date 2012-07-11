<?php
$this->pageTitle = "Nyhetsstrøm";
$this->layout = "//layouts/doubleColumn";

$this->beginClip('sidebar');
$this->widget('application.components.widgets.ActivitiesFeed');
$this->widget('application.components.widgets.JobAnnouncementFeed');
$this->endClip();
?>

<div class="feeds2">
	<? if ($hasPublishAccess): ?>
	<?=	CHtml::link("Publiser", array("news/create"), array(
			'class' => 'button buttonRightSide',
	))	?>
	<? endif ?>
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>

</div>
<?=CHtml::button('Vis flere', array(
	'class' => 'button buttonRightSide',
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
				$(".feeds2").append(html);
			},
			type: 'get',
			url: '<?= $ajaxFeedUrl ?>' + count,
			data: {
				index: $(".feeds2 li").size()
			},
			cache: false,
			dataType: 'html'
		});
		count += <?= $limit ?>;
	});
</script>
