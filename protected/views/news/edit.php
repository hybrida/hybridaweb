<? $this->pageTitle = "Rediger nyhet" ?>

<script type="text/javascript">
	$(document).ready(function(){
		var eventButton = $("#NewsEventForm_hasEvent")
		var signupButton = $("#NewsEventForm_hasSignup")

		var event = $(".event");
		var signup = $(".signup");

		function updateEvent () {
			if (eventButton.attr('checked')) {
				event.show();
			} else {
				event.hide();
				signupButton.attr('checked', false);
				updateSignup();
			}
		}

		function updateSignup (){
			if (eventButton.attr('checked') && signupButton.attr('checked')) {
				signup.show()
			} else if (! signupButton.checked) {
				signup.hide();
			}
		}

		eventButton.click(updateEvent);
		signupButton.click(updateSignup);

		updateSignup();
		updateEvent();
	});
</script>

<div class="g-form">

	<?php
	$form = $this->beginWidget('ActiveForm', array(
		'id' => 'news_edit-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		), 'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
		),
	));
	?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?= $form->errorSummary($model); ?>
	<?= $form->hiddenField($model, 'news[id]') ?> 
	<?= $form->hiddenField($model, 'event[id]') ?> 
	<?= $form->hiddenField($model, 'signup[id]') ?> 

		<div class="formHeader">
			<h1 class="formHeader">Nyhet</h1>
		</div>
		
		<div class="row">
			<?= $form->labelEx($model, 'news[title]'); ?> 
			<?= $form->textField($model, 'news[title]', array('class' => 'input_text')); ?> 
			<?= $form->error($model, 'news[title]'); ?> 
		</div>
		

		<div class="row">
			<?= $form->labelEx($model, 'news[ingress]'); ?> 
			<?= $form->textArea($model, "news[ingress]",array(
				'cols' => '50',
				'rows' => '6',
				'class'=> 'message',
			)); ?> 
			<?= $form->error($model, 'news[ingress]'); ?> 
		</div>
    
        <div class="row">
            <?= $form->labelEx($model, 'news[status]'); ?>
            <?= $form->radioButtonList($model, 'news[status]', array(
                Status::DELETED => 'Deleted',
                Status::DRAFT => 'Draft',
                Status::PUBLISHED => 'Published',
            )); ?>
            <?= $form->error($model, 'news[status]'); ?>
        </div>

				
		<div class="row">
			<?= $form->labelEx($model, 'news[content]'); ?> 
			<?= $form->richTextArea($model, "news[content]",array('class'=>'message')); ?>
			<? /*
			 * Her er det ingen validering (ingen $form>error)
			 * Dette er fordi validering ikke går hånd i hånd med
			 * CKEditor. 
			 */?> 
		</div>
	
		<div class="row">
			<label>Last opp bilde</label>
			<?= $form->fileField($model, 'imageUpload') ?>
			<?= $form->error($model, 'imageUpload') ?>
		</div>
			
		<div class="row">
			<label>Tilgang til nyhet</label>
			<div style="width: 85%; maring-left:150px">
				<?= $form->accessField($model, "news[access]"); ?> 
			</div>
			<?= $form->error($model, 'news[acces]'); ?>	
		</div>

			
<br clear="all" />
		<div class="formHeader">
			<h1>
				<?= $form->checkBox($model, 'hasEvent'); ?> 
				Hendelse
			</h1>
		</div>
		<div class="event">

		<div class="row">
			<?= $form->labelEx($model, 'event[start]'); ?>
			<?= $form->dateField($model, 'event[start]', array('class' => 'input_text')); ?> 
			<?= $form->error($model, 'event[start]'); ?> 
		</div>
		
		<div class="row">
			<?= $form->labelEx($model, 'event[end]'); ?>
			<?= $form->dateField($model, 'event[end]', array('class' => 'input_text')); ?>
			<?= $form->error($model, 'event[end]'); ?>				
		</div>			

		<div class="row">
			<label>Sted</label>
			<?= $form->textField($model, 'event[location]', array('class' => 'input_text')); ?>
			<?= $form->error($model, 'event[location]'); ?>				
		</div>

		<div class="formHeader">
			<h1>
				<?= $form->checkBox($model, 'hasSignup'); ?>
				Påmelding
			</h1>
		</div>
	</div>
	<div class="signup">
		<div class="row">
			<?= $form->labelEx($model, 'signup[spots]'); ?>
			<?= $form->textField($model, 'signup[spots]', array('class' => 'input_text')); ?>
			<?= $form->error($model, 'signup[spots]'); ?>				
		</div>
		
		<div class="row">
			<?= $form->labelEx($model, 'signup[open]'); ?>
			<?= $form->dateField($model, 'signup[open]', array('class' => 'input_text')); ?>
			<?= $form->error($model, 'signup[open]'); ?>				
		</div>
		
		<div class="row">
			<?= $form->labelEx($model, 'signup[close]'); ?>
			<?= $form->dateField($model, 'signup[close]', array('class' => 'input_text')); ?>
			<?= $form->error($model, 'signup[close]'); ?>				
		</div>
		
		<div class="row">
			<label>Tillat avmelding</label>
			<?= $form->checkBox($model, 'signup[signoff]',array(
				'value'=> 'true',
				'uncheckValue' => 'false',
			)); ?>
			<?= $form->error($model, 'signup[signoff]'); ?>				
		</div>
		<br>
		<div class="row">
			<label>Tillgang til påmelding</label>
			<div style="width: 85%; text-align: right;">
				<?= $form->accessField($model, 'signup[access]') ?>
			</div>
		</div>
	</div>

			<?= CHtml::submitButton('Lagre', array(
				'class'=> 'g-button'
			)); ?>

	<?php $this->endWidget(); ?>

</div>
