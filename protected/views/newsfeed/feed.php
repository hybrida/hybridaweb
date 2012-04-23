<? 
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar');
	$this->widget('application.components.widgets.ActivitiesFeed');
$this->endClip()
?>

<? $this->pageTitle = "Nyhetsstrøm" ?>

<?
// FIXME
// Forferdelig stygt, men fungerer.
?>
<div class="feedTitle">
</div>

<div class="feeds">
    <?=CHtml::button('Nyheter/Kalender', array(
    'class' => 'button buttonRightSide',
    'id' => 'toggleCalendar'
    ))?>
	<? if ($hasPublishAccess): ?>
	<?=	CHtml::link("Publiser", array("news/create"), array(
		'class' => 'button buttonRightSide',
	))	?>
	<? endif ?>
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>
</div>

<div class="calendar-switch"> </div>

<?=CHtml::button('Vis flere', array(
	'class' => 'button buttonRightSide',
	'id' => 'fetchNews',
))?>

<script>
	var count = <?= $index ?>;
	var calendarDiv = $(".calendar-switch");
	$(function loadCalendar() {
		calendarDiv.load("/calendar/default/ajax");
	});	
	$("#toggleCalendar").toggle(function flipCalendar(){
		$(".content").addClass("flip");
	},function(){
		$(".content").removeClass("flip");
	});
	$("#fetchNews").click(function fetchNews(){
		
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
