<div id="sliderContainer">
	<?= CHtml::activeHiddenField($this->model, $this->attribute, array('id' => 'fieldValue')) ?>
	<div id="slider">
	</div>
	<div id="sliderValue">
		<?= $value ?>
	</div>
</div>
<br>

<script>
	$(function() {
		<? if (isset($width)): ?>
			$( "#slider" ).css("width", <?= $width ?>);
		<? endif; ?>	
		$( "#slider" ).slider
			({
				value: <?= $value ?>,
				min: <?= $min ?>,
				max: <?= $max ?>,
				slide: function( event, ui ) {
					$( "#sliderValue" ).text( ui.value );
					$( "#fieldValue").val( ui.value );
				}
			}) ;
	});
</script>

