<?php
/* @var $this FrontpageBannerController */
/* @var $model FrontpageBanner */
/* @var $form CActiveForm */
?>

<div class="g-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'frontpage-banner-_form-form',
	'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
		),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imageUpload'); ?>
		<?php echo $form->fileField($model,'imageUpload'); ?>
		<?php echo $form->error($model,'imageUpload'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url'); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->