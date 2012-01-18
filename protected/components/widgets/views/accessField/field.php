<div class="accessField">
<? for ($sub = 0; $sub <= $subs; $sub++): ?>
	<?php
		$this->render('accessField/_field', array(
			'sub' => $sub,
		));
	?>
<? endfor ?>
</div>

<?=
CHtml::button('Ta med ny accessBlock', array(
	'class' => 'button',
	'id' => 'fetchNewAccessBlock',
))
?>

<script type="text/javascript">
	var sub = <?=$this->sub?>;
	$("#fetchNewAccessBlock").click(function(){
		
		$.ajax({
			success: function(html){
				$(".accessField").append(html);
				sub ++;
			},
			type: 'get',
			url: '<?=app()->createUrl('ajax/get/getAccessBlock', array(
				'name' => $this->name,
				'id' => $this->id,
				'sub' => '',
				))?>' + sub,
			cache: false,
			dataType: 'html'
		});
});
</script>