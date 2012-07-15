<h1>Kommentarer</h1>

<div class="comment-view-all">
	<?$this->render("comment.views.default._comments", array(
		'models' => Comment::getAll($formModel->type, $formModel->id),
	));?>
</div>

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
		<input type="submit" id="comment-submit" value="Send" />
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
	$loadUrl = Yii::app()->createUrl("/comment/default/view", array(
			'type' => $formModel->type,
			'id' => $formModel->id));
	$deleteUrl = Yii::app()->createUrl("/comment/default/delete", array('id' => ''));
	$submitUrl = Yii::app()->createUrl("/comment/default/submit");
?>
<script lang="javascript">

	$(document).ready(function() {
		jQuery('body')
		.undelegate('#comment-submit','click')
		.delegate('#comment-submit','click',function(){
			$.ajax({
				'type':'POST',
				'url':'<?= $submitUrl ?>',
				'cache':false,
				'data': $(this).parents("form").serialize(),
				'success':function(html){
					$(".comment-view-all").html(html)
					$("#CommentForm_content").val("")
				}
			});
			return false;
		});
		
		function flashComment(commentName) {
			var element = $('.' + commentName);
			element.css('background-color', '#ffc');
			element.animate({
				backgroundColor: '#fff'
			}, 2000, 'easeInOutSine');
		}
		
		function flashCurrentComment() {
			var commentName = window.location.hash.substring(1);
			flashComment(commentName)
		}
		flashCurrentComment();
	});

	function deleteComment(id) {
		var commentViewBox = $(".comment-view-all");
		var url = "<?= $deleteUrl ?>/" + id;
		var shouldDelete = confirm("Vil du slette kommentaren?");
		if (shouldDelete) {
			commentViewBox.load(url);
		}
	}
</script>