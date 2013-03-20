<?
$assetUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.components.widgets.assets'));
Yii::app()->clientScript->registerCssFile($assetUrl.'/rangePicker.css'); 
?>

<div id="sliderContainer">
	<div id="sliderValue">
		0
	</div>
	<br>
	<div id="slider">
	</div>
</div>
<br>

<script language="text/css">
</script>

<script>
	$(function() {
		$( "#slider" ).slider
			({
				value: 0,
				min: 0,
				max: 10,
				slide: function( event, ui ) {
					$( "#sliderValue" ).text( ui.value );
				}
			}) ;
	});
</script>

