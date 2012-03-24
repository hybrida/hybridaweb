<? 
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar');
	$this->widget('application.components.widgets.ActivitiesCalendar');
	$this->widget('application.components.widgets.ActivitiesFeed');
$this->endClip()
?>

<? $this->pageTitle = "Nyhetsstrøm" ?>

<?
// FIXME
// Forferdelig stygt, men fungerer.
?>
<div class="feedTitle">
    <h1 style="display: inline">Nyhetsstrøm</h1>
	<? if ($hasPublishAccess): ?>
	<?=	CHtml::link("Publiser", array("news/create"), array(
		'class' => 'button buttonRightSide',
	))	?>
	<? endif ?>
</div>

<div class="feeds">
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>
</div>

<div class="calendar"> </div>
<script language="javascript">
	$(".calendar").get("/calendar/ajax/");
</script>

<?=CHtml::button('Vis flere', array(
	'class' => 'button buttonRightSide',
	'id' => 'fetchNews',
))?>

<script>
	var count = <?= $index ?>;
	$("#fetchNews").click(function(){
		
		$.ajax({
			success: function(html){
				$(".feeds").append(html);
			},
			type: 'get',
			url: '<?php
	echo $this->createUrl("feedAjax", array(
		'offset' => ''
	))
?>' + count,
			data: {
				index: $(".feeds li").size()
			},
			cache: false,
			dataType: 'html'
		});
		count += <?= $limit ?>;
	});

</script>
