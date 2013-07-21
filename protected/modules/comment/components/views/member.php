<?php
$user = User::model()->findByPk(user()->id);
?>

<div class="widget-comment">
<h1>Kommentarer</h1>


	<? $this->widget('notifications.widgets.FollowButton', array(
		'id' => $this->id,
		'type' => $this->type,
	)); ?>

<div class="comment-view-all">
	<?php
	$this->render("comment.views.default._comments", array(
		'models' => $comments,
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

$griffOnUrl  = Yii::app()->createUrl("/comment/default/griffOn",  array('id' => '')) . "/";
$griffOffUrl = Yii::app()->createUrl("/comment/default/griffOff", array('id' => '')) . "/";

?>
<script lang="javascript">

var urlOn = '<?= $griffOnUrl ?>';
var urlOff = '<?= $griffOffUrl ?>';
var hasGriffedClassName = "c-userHasGriffed";
var hasGriffedAttribute = "data-isgriffed";

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

		function scrollToComment(id) {
			var idName = "comment-" + id;
			document.getElementsByClassName(idName)[0].scrollIntoView();
		}

		function flashCurrentComment() {
			var commentNameAndIDs = window.location.hash.substring(1);
			if (commentNameAndIDs != "") {
				var idsString = commentNameAndIDs.replace("comment-", "");
				var ids = idsString.split(",");
				var firstId = ids[0];
				for(var i = 0; i < ids.length; i++) {
					if (ids[i] < firstId)  {
						firstId = ids[i];
					}
					var commentName = "comment-" + ids[i];
					flashComment(commentName);
				}
				scrollToComment(firstId);
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

	function griff(id, element) {

		var griffButton = $(element);
		var count = griffButton.find(".count");
		var griffCount = parseInt(count.html());
		var userHasGriffed = griffButton.attr(hasGriffedAttribute) == "true";

		var url = "";
		if (userHasGriffed) {
			url = urlOff + id;
			runAjax(url, function(html) {
				count.html(griffCount - 1);
				griffButton.removeClass(hasGriffedClassName);
				griffButton.attr(hasGriffedAttribute, "false");
				console.log("It's off");
			});
		} else {
			url = urlOn + id;
			runAjax(url, function(html) {
				count.html(griffCount + 1);
				griffButton.addClass(hasGriffedClassName);
				griffButton.attr(hasGriffedAttribute, "true");
				console.log("It's on");
			});
		}
	}

	function runAjax(url, callback) {
		$.ajax({
			'url': url,
			'success': function (html) {
				callback(html);
			},
			'error': function(a, b) {
			}
		});
	}

	function setGriffButtonColors() {
		var comments = $(".c-griffButton");
		comments.each(function(i, item){
			item = $(item);
			if (item.attr('data-isgriffed') == "true") {
				item.addClass("c-userHasGriffed");
			}
		});
	}

	setGriffButtonColors();


</script>
</div>