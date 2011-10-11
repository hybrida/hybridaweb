<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'edit-group-form-edit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'a'); ?>
<?php
$this->widget('application.components.widgets.XHeditor',array(
	'language'=>'en', //options are en, zh-cn, zh-tw
	'config'=>array(
		'id'=>'news_content',
		'name'=>'EdigGroupForm[a]',
		'tools'=>'mini', // mini, simple, full or from XHeditor::$_tools, tool names are case sensitive
		'width'=>'70%',
		//see XHeditor::$_configurableAttributes for more
	),
	'contentValue'=>'', // default value displayed in textarea/wysiwyg editor field
	'htmlOptions'=>array('rows'=>5, 'cols'=>10),// to be applied to textarea
));
?>				<?php echo $form->error($model,'a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'b'); ?>
		<?php echo $form->checkBox($model,'b'); ?>
		<?php echo $form->error($model,'b'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c'); ?>
		<?php echo $form->textField($model,'c'); ?>
		<?php echo $form->error($model,'c'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->