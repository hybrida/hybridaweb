<? $this->pageTitle = "Rediger artikkel" ?>

<?php 

    $form = $this->beginWidget('ActiveForm', array(
		'id' => 'news_edit-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
			));
	?>

<div class="row">
			<?= $form->labelEx($model, 'title') ?>
			<?= $form->textField($model, 'title') ?>
			<?= $form->error($model, 'title') ?>

</div>

<div class="row">
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, "content"); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>


<input type="submit" class="button" />


<? $this->endWidget() ?>