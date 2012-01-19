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
			<?php echo $form->labelEx($model, 'article[title]'); ?>
			<?php echo $form->textField($model, 'article[title]'); ?>
			<?php echo $form->error($model, 'article[title]'); ?>

</div>

<div class="row">
    <?php echo $form->labelEx($model, 'article[content]'); ?>
    <?php echo $form->textArea($model, "article[content]"); ?>
    <?php echo $form->error($model, 'article[content]'); ?>
</div>

<h1><?= $title ?> </h1>

<p><?=$content?></p>

