<h1>Kommentarer</h1>

<? foreach ($models as $model): ?>
	<p><?= $model->content ?></p>
<? endforeach; ?>




<div class="form">

	<?php
	$form = $this->beginWidget('ActiveForm', array(
		'action' => '/comment/default/form',
		'id' => 'comment-form-form-form',
		'enableAjaxValidation' => false,
			));
	?>
	<?= $form->hiddenField($formModel, 'type') ?>
	<?= $form->hiddenField($formModel, 'id') ?>

	<div class="row">
		<?php
		echo $form->textArea($formModel, 'content', array(
			'width' => '400',
			'height' => '130',
		));
		?>
		<?php echo $form->error($formModel, 'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->