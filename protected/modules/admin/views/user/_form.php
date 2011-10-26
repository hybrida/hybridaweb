<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
<?php echo $form->textField($model,'username',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>75)); ?>
<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middleName'); ?>
<?php echo $form->textField($model,'middleName',array('size'=>60,'maxlength'=>75)); ?>
<?php echo $form->error($model,'middleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
<?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>75)); ?>
<?php echo $form->error($model,'lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specialization'); ?>
<?php echo $form->textField($model,'specialization'); ?>
<?php echo $form->error($model,'specialization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'graduationYear'); ?>
<?php echo $form->textField($model,'graduationYear',array('size'=>4,'maxlength'=>4)); ?>
<?php echo $form->error($model,'graduationYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member'); ?>
<?php echo $form->textField($model,'member',array('size'=>5,'maxlength'=>5)); ?>
<?php echo $form->error($model,'member'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
<?php echo $form->textField($model,'gender',array('size'=>7,'maxlength'=>7)); ?>
<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imageId'); ?>
<?php echo $form->textField($model,'imageId'); ?>
<?php echo $form->error($model,'imageId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phoneNumber'); ?>
<?php echo $form->textField($model,'phoneNumber'); ?>
<?php echo $form->error($model,'phoneNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastLogin'); ?>
<?php echo $form->textField($model,'lastLogin'); ?>
<?php echo $form->error($model,'lastLogin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cardinfo'); ?>
<?php echo $form->textField($model,'cardinfo',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'cardinfo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthdate'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'User[birthdate]',
								 //'language'=>'de',
								 'value'=>$model->birthdate,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,                                      
									 'changeYear'=>true,
									 ),
								 )
							 );
					; ?>
<?php echo $form->error($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'altEmail'); ?>
<?php echo $form->textField($model,'altEmail',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'altEmail'); ?>
	</div>


