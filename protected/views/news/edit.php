<? $this->pageTitle = "Rediger nyhet" ?>

<div class="form">
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

	<?php echo $form->errorSummary($model); ?>

	<?= $form->hiddenField($model, 'news[id]') ?>

	<?= $form->hiddenField($model, 'event[id]') ?>

	<?= $form->hiddenField($model, 'signup[id]') ?>

	<div class="news">
		<div class="formHeader">
			<h1>Nyhet</h1>
		</div>

		<div class="formElement">
			<div class="formLabel">
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'news[title]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'news[ingress]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'news[content]'); ?></div>
				<div class="formLabelRow"><?= $form->labelEx($model, 'news[access]') ?> </div>
			</div>

			<div class="formBox">
				<div class="formBoxRow">
					<?php echo $form->textField($model, 'news[title]'); ?>
					<?php echo $form->error($model, 'news[title]'); ?>				
				</div>

				<div class="formBoxRow">
					<?php echo $form->textArea($model, "news[ingress]",array(
						'cols' => '50',
						'rows' => '8',
						'xheditor' => false,
					)); ?>
					<?php echo $form->error($model, 'news[ingress]'); ?>				
				</div>
				
				<div class="formBoxRow">
					<?php echo $form->richTextArea($model, "news[content]"); ?>
					<?php echo $form->error($model, 'news[content]'); ?>				
				</div>
				<div class="formBoxRow">
					<?php echo $form->accessField($model, "news[access]"); ?>
					<?php echo $form->error($model, 'news[acces]'); ?>				
				</div>
			</div>

			<div class="rowCheck">
				<?php echo $form->labelEx($model, 'hasEvent'); ?>
				<?php echo $form->checkBox($model, 'hasEvent'); ?>
				<?php echo $form->error($model, 'hasEvent'); ?>
			</div>
		</div>
	</div>



	<div class="event">
		<div class="formHeader">
			<h1>Hendelse</h1>
		</div>

		<div class="formElement">
			<div class="formLabel">
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'event[start]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'event[end]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'event[location]'); ?></div>
<!--				<div class="formLabelRow"><?php echo $form->labelEx($model, 'event[imageId]'); ?></div>-->
			</div>

			<div class="formBox">
				<div class="formBoxRow">
					<?php echo $form->dateField($model, 'event[start]'); ?>
					<?php echo $form->error($model, 'event[start]'); ?>				
				</div>

				<div class="formBoxRow">
					<?php echo $form->dateField($model, 'event[end]'); ?>
					<?php echo $form->error($model, 'event[end]'); ?>				
				</div>

				<div class="formBoxRow">
					<?php echo $form->textField($model, 'event[location]'); ?>
					<?php echo $form->error($model, 'event[location]'); ?>				
				</div>

<!--				<div class="formBoxRow">
					<?php echo $form->textField($model, 'event[imageId]'); ?>
					<?php echo $form->error($model, 'event[imageId]'); ?>				
				</div>-->
			</div>

			<div class="rowCheck">
				<?php echo $form->labelEx($model, 'hasSignup'); ?>
				<?php echo $form->checkBox($model, 'hasSignup'); ?>
				<?php echo $form->error($model, 'hasSignup'); ?>
			</div>
		</div>
	</div>
	<div class="signup">
		<div class="formHeader">
			<h1>Påmelding</h1>
		</div>

		<div class="formElement">
			<div class="formLabel">
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'signup[spots]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'signup[open]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'signup[close]'); ?></div>
				<div class="formLabelRow"><?php echo $form->labelEx($model, 'signup[signoff]'); ?></div>
			</div>

			<div class="formBox">
				<div class="formBoxRow">
					<?php echo $form->textField($model, 'signup[spots]'); ?>
					<?php echo $form->error($model, 'signup[spots]'); ?>				
				</div>

				<div class="formBoxRow">
					<?php echo $form->dateField($model, 'signup[open]'); ?>
					<?php echo $form->error($model, 'signup[open]'); ?>				
				</div>

				<div class="formBoxRow">
					<?php echo $form->dateField($model, 'signup[close]'); ?>
					<?php echo $form->error($model, 'signup[close]'); ?>				
				</div>

				<div class="formBoxRow">
					<?php echo $form->checkBox($model, 'signup[signoff]',array(
						'value'=> 'true',
						'uncheckValue' => 'false',
					)); ?>
					<?php echo $form->error($model, 'signup[signoff]'); ?>				
				</div>
				
				<div class="formBoxRow">
					<?= $form->accessField($model, 'signup[access]') ?>
				</div>
			</div>
		</div>
	</div>

	<div class="formElement">
		<div class="formSubmit">
			<?php echo CHtml::submitButton('Lagre', array(
				'class'=> 'button'
			)); ?>
		</div>
	</div>

	<!--<?php $this->endWidget(); ?>-->

</div>