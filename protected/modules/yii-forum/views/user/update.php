<?php
$this->widget('zii.widgets.CBreadcrumbs', array('links'=>array(
    'Forum'=>array('/forum'),
    $model->name=>array('/forum/user/view', 'id'=>$model->id),
    'Update',
)));
?>

<div class="form" style="margin:20px;">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'forumuser-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
    )); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'signature'); ?>
            <?php echo $form->textArea($model,'signature', array('rows'=>5, 'cols'=>70)); ?>
            <?php echo $form->error($model,'signature'); ?>
            <p class="hint">
                Hint: You can use <?php echo CHtml::link('markdown', 'http://daringfireball.net/projects/markdown/syntax'); ?> syntax!
            </p>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Submit'); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
