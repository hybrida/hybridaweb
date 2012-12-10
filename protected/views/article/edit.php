<? $this->pageTitle = "Rediger artikkel" ?>

<?php 
    $form = $this->beginWidget('ActiveForm', array(
		'id' => 'article_edit-form',
		//'enableAjaxValidation' => true, // Ødelegger redirect.
		'enableClientValidation' => true,
		'htmlOptions' => array(
			'class' => 'g-form',
		),
		'clientOptions' => array(
			'validateOnSubmit' => true,
		)));
	?>

		<h1>Rediger underside</h1>
	
	<div class="row">
		<?= $form->labelEx($model, 'Tittel') ?>
		<?= $form->textField($model, 'title') ?>
		<?= $form->error($model, 'title') ?>
	</div>
		
	<div class="row">
		<?= $form->labelEx($model, 'shorttitle') ?>
		<?= $form->textField($model, 'shorttitle') ?>
		<?= $form->error($model, 'shorttitle') ?>
	</div>
	
	<div class="row">
		<?= $form->labelEx($model, 'Foreldreartikkel') ?>
		<?= $form->dropDownList($model, 'parentId', Article::getTreeList()) ?>
		<?= $form->error($model, 'parentId') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'phpFile') ?>
		<?= $form->textField($model, 'phpFile') ?>
		<?= $form->error($model, 'phpFile') ?>
	</div>

    <div class="row">
        <?= $form->labelEx($model, 'content') ?>
        <?= $form->richTextArea($model, 'content') ?>
        <?= $form->error($model, 'content') ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model, 'Tilganger'); ?>
		<?php echo $form->accessField($model, 'access'); ?>
		<?php echo $form->error($model, 'access'); ?>				
	</div>

	<?php echo CHtml::submitButton('Lagre', array(
		'class'=> 'g-button'
	)); ?>

<? $this->endWidget() ?>
