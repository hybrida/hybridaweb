<div class="createAlbum">
	<h1>Create Album</h1>

	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'album-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)); ?>



		<p class="error">
		<? foreach($errors as $error): ?>
				<? print_r($error) ?>
			<br>
		<? endforeach; ?>
		</p>

		<div class="row">
			Albumtittel
			<?php echo $form->textField($model,'title'); ?>
		</div>

		<div class="row">
			<? $this->widget('application.extensions.Plupload.PluploadWidget', array(
			   'config' => array(
					'url' => $this->createUrl('upload'),
					'chunk_size' => '1mb',
					'autostart' => true,
					'jquery_ui' => false,
			   ),
			   'id' => 'uploader'
			)); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
</div>
