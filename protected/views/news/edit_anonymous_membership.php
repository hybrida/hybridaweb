<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'signup-membership-anonymous-edit_anonymous_membership-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'g-form',
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName'); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName'); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<? if (isset($emailVerify) && $emailVerify === true): ?>
		<div class="row">
			<label>Gjenta epostadresse</label>
			<?php echo $form->textField($model,'emailVerify'); ?>
			<?php echo $form->error($model,'emailVerify'); ?>
		</div>
	<? endif ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('class' => 'g-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->