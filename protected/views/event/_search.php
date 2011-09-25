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
		<?php echo $form->label($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end'); ?>
		<?php echo $form->textField($model,'end'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'access'); ?>
		<?php echo $form->textField($model,'access'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imageId'); ?>
		<?php echo $form->textField($model,'imageId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->