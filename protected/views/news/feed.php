<?
// FIXME
// Forferdelig stygt, men fungerer.
?>
<div class="feedTitle">
    <h1 style="display: inline">Nyhetsstrøm</h1>
    <?= CHtml::link("Publiser", array("news/create"), array(
        'class' => 'button buttonRightSide',
    )) ?>
</div>

<div class="heavyBorder"></div>


<div class="feeds">
	<?
	$this->renderPartial("_feed", array(
		'models' => $models,
	));
	$index += count($models);
	?>
</div>

	<?=
	CHtml::button('Mer', array(
		'class' => 'button buttonRightSide',
                'id'    => 'fetchNews',
	))
	?>

	<script>
		var count = <?=$index?>;
		$("#fetchNews").click(function(){

			$.ajax({
				success: function(html){
					$(".feeds").append(html);
				},
				type: 'get',
				url: '<?php echo $this->createUrl("feedAjax",array(
					'offset' => ''
					)) ?>' + count,
				data: {
					index: $(".feeds li").size()
				},
				cache: false,
				dataType: 'html'
			});
			count += <?= $limit ?>;
		});

	</script>
