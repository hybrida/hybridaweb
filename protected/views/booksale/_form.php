<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-sale-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'g-form'
	),
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tittel'); ?>
		<?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>30,'class' => 'input_text')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'beskrivelse'); ?>
                <br/>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50,'class' => 'input_text')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pris'); ?>
		<?php echo $form->textField($model,'price',array('size'=>6,'class' => 'input_text')); ?>Kroner
		<?php echo $form->error($model,'price'); ?>
	</div>
        
        <div class="row">
                <?= $form->labelEx($model,'status') ?>
                <?= $form->dropDownList($model, 'status', array(
					BookSale::SOLD => "Solgt",
					BookSale::FOR_SALE => "Til salgs")) ?>
                <?= $form->error($model, 'status') ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'imageID'); ?>
		<?php echo $form->textField($model,'imageID',array('class' => 'input_text')); ?>
		<?php echo $form->error($model,'imageID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->