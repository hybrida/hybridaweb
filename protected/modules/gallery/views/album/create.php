<?
$this->breadcrumbs = array(
	'Galleri' => array('/gallery'),
);
?>

<div class="createAlbum">
	<h1><?= $new ? "Opprett Album" : "Endre Album"?></h1>

	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'album-form',
		'action'=>Yii::app()->createUrl('/gallery/create'),
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)); ?>

		<?= CHtml::hiddenField('new', $new ? 0 : $model->id, array('id' => 'new')); ?>

		<div class="row">
			Albumtittel
			<?php echo $form->textField($model,'title', array('size' => 50, 'maxlength' => 50, 'readonly' => !($new || Yii::app()->user->id == $model->user_id))); ?>
		</div>

		<div class="row">
			<? $this->widget('application.extensions.Plupload.PluploadWidget', array(
			   'config' => array(
					'url' => $this->createUrl('upload'),
					'chunk_size' => '8mb',
					'autostart' => true,
					'jquery_ui' => false,
					'filters' => array( array('title' => 'Bildefiler', 'extensions' =>'jpg,jpeg,gif,png'),   ),
					'max_file_size' => '10mb'
			   ),
			   'id' => 'uploader'
			)); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton($new ? 'Opprett' : 'Lagre'); ?>
		</div>

	<?php $this->endWidget(); ?>

	<p class="errorText">
	<? foreach($errors as $error): ?>
			<?= $error ?>
		<br>
	<? endforeach; ?>
	</p>

	<p>
	OBS:
		<ul>
			<li> Vent til alle bildene er lastet før du trykker <?= $new ? 'Opprett' : 'Lagre'?> </li>
			<li> Bare filtypene gif, png og jpg er støttet </li>
			<li> Maks filstørrelse er 10 MB </li>
			<li> Chrome kan være treg til å laste opp filer, så bruk gjerne en annen browser om du skal laste opp mange bilder </li>
		</ul>
	</p>

	</div><!-- form -->
</div>
