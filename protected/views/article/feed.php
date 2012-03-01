<? $this->pageTitle = "Artikkelstrøm" ?>

<?$this->breadcrumbs=array(
	'Article feed' => array("/article/feed")
);?>

<div class="feedTitle">
    <h1 style="display: inline">Artikkelstrøm</h1>
	<? if ($hasPublishAccess): ?>
	<?=	CHtml::link("Ny artikkel", array("article/create"), array(
		'class' => 'button buttonRightSide',
	))	?>
	<? endif ?>
</div>

<div class="heavyBorder"></div>

<div class="feeds">
	<?	$this->renderPartial("_feed", array(
		'models' => $models,
	));	?>
</div>

<?=CHtml::button('Vis flere (Funker ikke)', array(
	'class' => 'button buttonRightSide',
	'id' => 'fetchArticle',
))?>

<script>
	var count = <?= $index ?>;
	$("#fetchArticle").click(function(){
		
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