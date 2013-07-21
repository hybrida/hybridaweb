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
	$this->render("comment.views._comments", array(
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
	var deleteComment;
	require(['comments/comment'], function(comment) {
		comment.setData({
			deleteUrl: '<?= $deleteUrl ?>',
			submitUrl: '<?= $submitUrl ?>'
		});
		deleteComment = comment.deleteComment;
	});

	var griff;
	require(['comments/griff'], function(griffModule) {
		griffModule.setData({
			griffOnUrl: '<?= $griffOnUrl ?>',
			griffOffUrl: '<?= $griffOffUrl ?>'
		});

		griff = griffModule.griff;
	});

</script>
</div>