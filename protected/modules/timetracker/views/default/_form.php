<?php
/* @var $this TrackerLogController */
/* @var $model TrackerLog */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	$this->module->id => $this->createUrl("index"),
	"Legg til ny"
);

?>



<div class="timetrackerForm">

	<h1>Fyll inn ny dag</h1>
	<p>
		Gammel data vil bli overskrevet
	</p>

	<div class="g-form">
	<?php $form=$this->beginWidget('ActiveForm', array(
		'id'=>'tracker-log-_form-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation' => false,
	)); ?>

		<?php echo $form->errorSummary($model); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'date'); ?>
			<?php echo $form->dateField($model,'date'); ?>
			<?php echo $form->error($model,'date'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'work_time'); ?>
			<?php echo $form->textField($model,'work_time'); ?>
			<?php echo $form->error($model,'work_time'); ?>
		</div>


		<div class="row buttons">
			<?php echo CHtml::submitButton('Submit', array(
			'class' => 'g-button')); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->

	<h2>Regler</h2>
	<ul>
		<li>Tiden som fylles inn er aktiv tid uten pauser</li>
		<li>Lunsj er ikke arbeid</li>
	</ul>

</div>