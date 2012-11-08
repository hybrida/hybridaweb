<div class="updateAlbum">
	<h1>Endre Album</h1>

	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'album-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)); ?>



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
			<?php echo CHtml::submitButton('Lagre'); ?>
		</div>

	<?php $this->endWidget(); ?>

	<p class="error">
	<? foreach($errors as $error): ?>
			<?= $error ?>
		<br>
	<? endforeach; ?>
	</p>

	</div><!-- form -->
</div>
