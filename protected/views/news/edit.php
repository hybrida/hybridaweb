<div class="form">

	<?php
	$form = $this->beginWidget('ActiveForm', array(
			'id' => 'news_edit-form',
			'enableClientValidation' => true,
			'clientOptions' => array(
					'validateOnSubmit' => true,
			),
					));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?= $form->hiddenField($model,'news[id]')?>
	
	<?= $form->hiddenField($model,'event[id]')?>
	
	<?= $form->hiddenField($model,'signup[id]')?>
	

	<div class="row">
		<?php echo $form->labelEx($model, 'hasNews'); ?>
		<?php echo $form->checkBox($model, 'hasNews'); ?>
		<?php echo $form->error($model, 'hasNews'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'hasSignup'); ?>
		<?php echo $form->checkBox($model, 'hasSignup'); ?>
		<?php echo $form->error($model, 'hasSignup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'hasEvent'); ?>
		<?php echo $form->checkBox($model, 'hasEvent'); ?>
		<?php echo $form->error($model, 'hasEvent'); ?>
	</div>

	<div class="news">
		<h1>News</h1>
		<div class="row">
			<?php echo $form->labelEx($model, 'news[title]'); ?>
			<?php echo $form->textField($model, 'news[title]'); ?>
			<?php echo $form->error($model, 'news[title]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'news[content]'); ?>
			<?php echo $form->textArea($model, "news[content]"); ?>
			<?php echo $form->error($model, 'news[content]'); ?>
		</div>
	</div>

	<div>
		<h1>Hendelse</h1>

		<div class="row">
			<?php echo $form->labelEx($model, 'event[start]'); ?>
			<?php echo $form->textField($model, 'event[start]'); ?>
			<?php echo $form->error($model, 'event[start]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'event[end]'); ?>
			<?php echo $form->textField($model, 'event[end]'); ?>
			<?php echo $form->error($model, 'event[end]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'event[location]'); ?>
			<?php echo $form->textField($model, 'event[location]'); ?>
			<?php echo $form->error($model, 'event[location]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'event[title]'); ?>
			<?php echo $form->textField($model, 'event[title]'); ?>
			<?php echo $form->error($model, 'event[title]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'event[imageId]'); ?>
			<?php echo $form->textField($model, 'event[imageId]'); ?>
			<?php echo $form->error($model, 'event[imageId]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'event[content]'); ?>
			<?php echo $form->textArea($model, 'event[content]'); ?>
			<?php echo $form->error($model, 'event[content]'); ?>
		</div>
	</div>
	<div>
		<h1>Påmelding</h1>

		<div class="row">
			<?php echo $form->labelEx($model, 'signup[spots]'); ?>
			<?php echo $form->textField($model, 'signup[spots]'); ?>
			<?php echo $form->error($model, 'signup[spots]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'signup[open]'); ?>
			<?php echo $form->textField($model, 'signup[open]'); ?>
			<?php echo $form->error($model, 'signup[open]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'signup[close]'); ?>
			<?php echo $form->textField($model, 'signup[close]'); ?>
			<?php echo $form->error($model, 'signup[close]'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'signup[signoff]'); ?>
			<?php echo $form->textField($model, 'signup[signoff]'); ?>
			<?php echo $form->error($model, 'signup[signoff]'); ?>
		</div>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>