<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'username'); ?>
                <?php echo $form->textField($model,'username',array('size'=>10,'maxlength'=>10)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'firstName'); ?>
                <?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>75)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'middleName'); ?>
                <?php echo $form->textField($model,'middleName',array('size'=>60,'maxlength'=>75)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'lastName'); ?>
                <?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>75)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'specialization'); ?>
                <?php echo $form->textField($model,'specialization'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'graduationYear'); ?>
                <?php echo $form->textField($model,'graduationYear',array('size'=>4,'maxlength'=>4)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'member'); ?>
                <?php echo $form->textField($model,'member',array('size'=>5,'maxlength'=>5)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'gender'); ?>
                <?php echo $form->textField($model,'gender',array('size'=>7,'maxlength'=>7)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'imageId'); ?>
                <?php echo $form->textField($model,'imageId'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'phoneNumber'); ?>
                <?php echo $form->textField($model,'phoneNumber'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'lastLogin'); ?>
                <?php echo $form->textField($model,'lastLogin'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'cardinfo'); ?>
                <?php echo $form->textField($model,'cardinfo',array('size'=>10,'maxlength'=>10)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'birthdate'); ?>
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
        </div>

        <div class="row">
                <?php echo $form->label($model,'altEmail'); ?>
                <?php echo $form->textField($model,'altEmail',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
