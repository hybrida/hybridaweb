<?php
$user = User::model()->findByPk(user()->id);
?>

<div class="widget-comment">
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

	<div class="c-comment">
		<div class="c-profileImage">
			<?= Image::profileTag($user->imageId, 'xsmall') ?>
		</div>

		<div class="c-right">
			<div class="c-header">
				<span class="c-author"><?= $user->fullName ?></span>
				<span class="c-date c-date-without-delete">
					<?= Html::dateToString(date('j.m.Y H:i'), 'mediumlong') ?>
				</span>
			</div>
			<div class="c-content">
				<?php
				echo $form->textArea($formModel, 'content', array(
					'cols' => 50,
					'rows' => 3,
				));
				?>
				<br>
				<input type="submit" id="comment-submit" value="Send" class="g-button" />
				<?= $form->error($formModel, 'content'); ?>
			</div>
		</div>
	</div>


	<div class="row">
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
			comment.addClass("c-flashed");
		}

		function flashCurrentComment() {
			var commentNameAndIDs = window.location.hash.substring(1);
			if (commentNameAndIDs != "") {
				var idsString = commentNameAndIDs.replace("comment-", "");
				var ids = idsString.split(",");
				for(var i = 0; i < ids.length; i++) {
					var commentName = "comment-" + ids[i];
					flashComment(commentName);
				}
			}
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
</div>