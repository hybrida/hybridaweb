<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>
<i>Denne erroren ble fanget opp i <?= __FILE__ ?></i>
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>