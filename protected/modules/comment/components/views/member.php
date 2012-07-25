<h1>Kommentarer</h1>

<div class="comment-view-all">
	<?php
	$this->render("comment.views.default._comments", array(
		'models' => Comment::getAll($formModel->type, $formModel->id),
	));
	?>
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
		<?= $form->error($formModel, 'content'); ?>
	</div>

	<div class="row">
		<input type="submit" id="comment-submit" value="Send" class="g-button" />
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$deleteUrl = Yii::app()->createUrl("/comment/default/delete", array('id' => ''));
$submitUrl = Yii::app()->createUrl("/comment/default/submit");
?>
<script lang="javascript">
	$(document).ready(function() {
		
		function attachSubmitAction() {
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
		}
		
		function flashComment(commentName) {
			var comment = $('.' + commentName);
			comment.css('background-color', '#ffa');
			comment.animate({
				backgroundColor: '#fff'
			}, 3000, 'easeInOutSine');
		}
		
		function flashCurrentComment() {
			var commentName = window.location.hash.substring(1);
			flashComment(commentName)
		}
		
		attachSubmitAction();
		flashCurrentComment();
	});
	
	function deleteComment(id) {
		var commentViewAll = $(".comment-view-all");
		var url = "<?= $deleteUrl ?>/" + id;
		var shouldDelete = confirm("Vil du slette kommentaren?");
		if (shouldDelete) {
			commentViewAll.load(url);
		}
	}
</script>