<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form-form-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hasNews'); ?>
		<?php echo $form->checkBox($model,'hasNews'); ?>
		<?php echo $form->error($model,'hasNews'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hasSignup'); ?>
		<?php echo $form->checkBox($model,'hasSignup'); ?>
		<?php echo $form->error($model,'hasSignup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hasEvent'); ?>
		<?php echo $form->checkBox($model,'hasEvent'); ?>
		<?php echo $form->error($model,'hasEvent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news[title]'); ?>
		<?php echo $form->textField($model,'news[title]'); ?>
		<?php echo $form->error($model,'news[title]'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Innhold'); ?>
<?php 
            $this->widget('application.components.widgets.XHeditor',array(
                'language'=>'en', //options are en, zh-cn, zh-tw
                'config'=>array(
                    'id'=>'xh1',
                    'name'=>'xh',
                    'tools'=>'full', // mini, simple, fill or from XHeditor::$_tools
                    'width'=>'100%',
										'height' => "400",
                    //see XHeditor::$_configurableAttributes for more
                ),
                'htmlOptions'=>array('rows'=>5, 'cols'=>10),// to be applied to textarea
            ));
            ?>
		<?php echo $form->error($model,'news[content]'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Send inn'); ?>
		<?php echo CHtml::resetButton(); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->