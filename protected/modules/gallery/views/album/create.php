<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Galleri', '/gallery/', array('confirm' => 'Dette vil avbryte det du holder på med')) ?>
		</li>
	</ul>
</div>

<? $this->endClip(); ?>

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
			<?php echo $form->textField($model,'title'); ?>
		</div>

		<div class="row">
			<? $this->widget('application.extensions.Plupload.PluploadWidget', array(
			   'config' => array(
					'url' => $this->createUrl('upload'),
					'chunk_size' => '8mb',
					'autostart' => true,
					'jquery_ui' => false,
					'filters' => array( array('title' => 'Bildefiler', 'extensions' =>'jpg,jpeg,gif,png'),   ),
			   ),
			   'id' => 'uploader'
			)); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton($new ? 'Opprett' : 'Lagre'); ?>
		</div>

	<?php $this->endWidget(); ?>

	<p class="error">
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
			<li> Om du skulle glemme tittel etter å ha lastet opp bildene, trenger du ikke laste dem opp på nytt. Bare trykk <?= $new ? 'Opprett' : 'Lagre'?></li>
		</ul>
	</p>

	</div><!-- form -->
</div>
