<h1>Kommentarer</h1>

<? foreach ($models as $model): ?>
<p><?= $model->content ?></p>

<? endforeach; ?>


<div class="form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'action' => '/comment/default/form',
	'id'=>'comment-form-form-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?= $form->hiddenField($formModel, 'type') ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($formModel); ?>

	<div class="row">
		<?php echo $form->labelEx($formModel,'content'); ?>
		<?php echo $form->textArea($formModel,'content'); ?>
		<?php echo $form->error($formModel,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->