<? $this->pageTitle = "Rediger nyhet" ?>

<div class="g-form">
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
			
			//updateSignup();
			//updateEvent();
		});
	</script>
<style>

	div.g-form {
		margin:0 auto;
		position:relative;
	}


	div.g-form .row {
		width:100%;
		display: block;
		
		/*border-top:1px solid #ccc;
		border-bottom:1px solid #ccc;*/
		padding:10px 0 10px 0;
	}

	div.g-form .row label {
		display: block;
		
		font-size:1em;
		font-weight: bold;
		float:left;
		width:15%;
		text-align:right;
		padding:5px 20px 0 0;
	}
	
	div.g-form .errorMessage {
		color: #F00;
	}

	
	div.g-form .errorMessage:before {
		content: " ";
		background-image: url("http://icons.iconarchive.com/icons/kyo-tux/phuzion/16/Sign-Error-icon.png");
		background-repeat: no-repeat;
		width: 20px;
		height: 16px;
		display:block;
		float:left;
	}

	div.g-form .input_text {
		padding:5px 5px;
		width:250px;
		font-size: 0.9em;
	}

	div.g-form .message{
		padding:7px 7px;
		width:350px;
		overflow:hidden;
		height:150px;
	}
	
	div.g-form .row .rowField {
		width: 85%;
		float:left;
		display:block;
		position:relative;
	}


</style>
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
				'rows' => '8',
				'class'=> 'message',
			)); ?> 
			<?= $form->error($model, 'news[ingress]'); ?> 
		</div>

				
		<div class="row">
			<?= $form->labelEx($model, 'news[content]'); ?> 
			<?= $form->richTextArea($model, "news[content]",array('class'=>'message')); ?>
			<?= $form->error($model, 'news[content]'); ?> 
		</div>
			
		<div class="row">
			<label>Tilgang til nyhet</label>
			<?= $form->accessField($model, "news[access]"); ?> 
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
				
		<div class="row">
			<?= $form->labelEx($model, 'event[imageId]'); ?>
			<?= $form->textField($model, 'event[imageId]'); ?>
			<?= $form->error($model, 'event[imageId]'); ?>				
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
			<?= $form->textField($model, 'signup[spots]'); ?>
			<?= $form->error($model, 'signup[spots]'); ?>				
		</div>
		
		<div class="row">
			<?= $form->labelEx($model, 'signup[open]'); ?>
			<?= $form->dateField($model, 'signup[open]'); ?>
			<?= $form->error($model, 'signup[open]'); ?>				
		</div>
		
		<div class="row">
			<?= $form->labelEx($model, 'signup[close]'); ?>
			<?= $form->dateField($model, 'signup[close]'); ?>
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
			<div class="">
				<?= $form->accessField($model, 'signup[access]') ?>
			</div>
		</div>
	</div>

			<?= CHtml::submitButton('Lagre', array(
				'class'=> 'button'
			)); ?>

	<?php $this->endWidget(); ?>

</div>