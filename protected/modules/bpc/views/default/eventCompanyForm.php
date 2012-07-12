<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'event-company-eventCompanyForm-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array(
			'class' => 'g-form',
		),
			));
	?>

	<h1><?= $news->title ?></h1>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'companyID'); ?>
		<?php echo $form->dropDownList($model, 'companyID', Html::getCompaniesDropDownArray()); ?>
		<?php echo $form->error($model, 'companyID'); ?>
	</div>


	<div class="row buttons">
		<?=	CHtml::submitButton('Submit', array(
			'class' => 'button'
		)) ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->