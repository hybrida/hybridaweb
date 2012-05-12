<h1>Kommentarer</h1>

<div class="comment-view-all"></div>



<div class="comment-view-form">

	<?php
	$form = $this->beginWidget('ActiveForm', array(
		'id' => 'comment-form-form-form',
		'enableAjaxValidation' => false,
			));
	?>
	<?= $form->hiddenField($formModel, 'type') ?>
	<?= $form->hiddenField($formModel, 'id') ?>

	<div class="row">
		<?php
		echo $form->textArea($formModel, 'content', array(
			'cols' => 60,
			'rows' => 10,
		));
		?>
		<?php echo $form->error($formModel, 'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton("Send", Yii::app()->createUrl("/comment/default/submit") ,array(
			'update' => '.comment-view-all',
		), array(
			'class' => 'comment-form-submit'
		)) ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
	
<script lang="javascript" >
$(function() {
	var commentViewBox = $(".comment-view-all");
	commentViewBox.load("<?= Yii::app()->createUrl("/comment/default/view", array(
			'type' => $formModel->type,
			'id' => $formModel->id,
		))?>")
});
				
function deleteComment(id) {
	var commentViewBox = $(".comment-view-all");
	var url = "<?= Yii::app()->createUrl("/comment/default/delete", array('id' => ''))?>/" + id;
	var shouldDelete = confirm("Vil du slette kommentaren?");
	if (shouldDelete) {
		commentViewBox.load(url);
	}
	
}
</script>