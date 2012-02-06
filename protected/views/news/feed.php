<? 
$this->layout = "//layouts/doubleColumn";
$this->beginWidget('CClipWidget', array('id' => 'sidebar'));
$this->widget('application.components.widgets.ActivitiesCalendar');
$this->widget('application.components.widgets.ActivitiesFeed');
$this->endWidget()
?>

<? $this->pageTitle = "Nyhetsstrøm" ?>

<?
// FIXME
// Forferdelig stygt, men fungerer.
?>
<div class="feedTitle">
    <h1 style="display: inline">Nyhetsstrøm</h1>
	<?=	CHtml::link("Publiser", array("news/create"), array(
		'class' => 'button buttonRightSide',
	))	?>
</div>

<div class="heavyBorder"></div>


<div class="feeds">
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>
</div>

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
