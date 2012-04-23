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

    <?=CHtml::link('Listevisning / Kalendervisning', '#', array(
    'class' => '',
    'id' => 'toggleCalendar'
    ))?>
<div class="feeds">
	<? if ($hasPublishAccess): ?>
	<?=	CHtml::link("Publiser", array("news/create"), array(
		'class' => 'button buttonRightSide',
	))	?>
	<? endif ?>
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>

<?=CHtml::button('Vis flere', array(
	'class' => 'button buttonRightSide',
	'id' => 'fetchNews',
))?>
</div>

<div class="calendar-switch"> </div>

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
