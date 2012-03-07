<? $this->pageTitle = "Rediger artikkel" ?>

<?php 
    $form = $this->beginWidget('ActiveForm', array(
		'id' => 'article_edit-form',
		//'enableAjaxValidation' => true, // Ødelegger redirect.
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		)));
	?>

<div class="form">
	<div class="formHeader">
		<h1>Artikkel</h1>
	</div>

	<div class="row">
				<?= $form->labelEx($model, 'title') ?>
				<?= $form->textField($model, 'title') ?>
				<?= $form->error($model, 'title') ?>
	</div>
	
	<div class="row">
				<?= $form->labelEx($model, 'parentId') ?>
				<?= $form->textField($model, 'parentId') ?>
				<?= $form->error($model, 'parentId') ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'content'); ?>
		<?php echo $form->textArea($model, 'content',array(
					'cols' => '150',
					'rows' => '8',
					'xheditor' => true,
		)); ?>
		<?php echo $form->error($model, 'content'); ?>
	</div>

	<div class="formElement">
		<div class="formSubmit">
			<?php echo CHtml::submitButton('Lagre', array(
				'class'=> 'button'
			)); ?>
		</div>
	</div>
</div>

<? $this->endWidget() ?>