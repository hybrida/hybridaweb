<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'alumni',
	'action' => '/alumni/form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->hiddenField($model,'event_id', array('value' => $eid)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'navn'); ?>
		<?php echo $form->textField($model,'navn'); ?>
		<?php echo $form->error($model,'navn'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
<? if(isset($msg)): ?>
	<?= $msg ?>
<? endif; ?>

</div><!-- form -->
