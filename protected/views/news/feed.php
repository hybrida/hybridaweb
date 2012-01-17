<h1>Nyhetsstrøm</h1>

<?= CHtml::link("Publiser", array("news/create")) ?>

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
		'class' => 'button buttonRightSide'
	))
	?>
<? app()->clientScript->registerCoreScript("jquery") ?>
	<script>
		var count = <?=$index?>;
		$(".fetchNews").click(function(){

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
