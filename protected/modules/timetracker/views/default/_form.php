<?php
/* @var $this TrackerLogController */
/* @var $model TrackerLog */
/* @var $form CActiveForm */
?>

<div class="g-form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'tracker-log-_form-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation' => false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->dateField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_time'); ?>
		<?php echo $form->textField($model,'work_time'); ?>
		<?php echo $form->error($model,'work_time'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array(
		'class' => 'g-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->