<div id="sliderContainer">
	<?= CHtml::activeHiddenField($this->model, $this->attribute, array('id' => 'fieldValue')) ?>
	<div id="sliderValue">
		<?= $value ?>
	</div>
	<br>
	<div id="slider">
	</div>
</div>
<br>

<script>
	$(function() {
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

