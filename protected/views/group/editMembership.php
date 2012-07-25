<div class="g-form">	
		<div class="formHeader">
			<h1 class="formHeader"><?=$group->title ?> - <?=$user->fullName ?></h1>
		</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-membership-editMembership-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comission'); ?>
		<?php echo $form->textField($model,'comission', array('class' => 'input_text')); ?>
		<?php echo $form->error($model,'comission'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start', array('class' => 'input_text')); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>


	<div class="row">
		<?php echo CHtml::submitButton('Submit', array(
			'class' => 'g-button'
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->