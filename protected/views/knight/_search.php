<?php
/* @var $this KnightController */
/* @var $model Knight */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'graduationYear'); ?>
		<?php echo $form->textField($model,'graduationYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'grantYear'); ?>
		<?php echo $form->textField($model,'grantYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reason'); ?>
		<?php echo $form->textArea($model,'reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->