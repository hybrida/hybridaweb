<? foreach ($models as $model): ?>
	<div class="comment comment-<?= $model->id ?>">
		<a name="comment-<?= $model->id ?>"></a>
		<div class="comment-left">
			<div class="profile-image">
				<?= Image::profileTag($model->author->imageId, 'xsmall') ?>
			</div>
		</div>

		<div class="comment-right">
			<div class="comment-title">
				<? if ($model->hasDeleteAccess()): ?>
					<button class="g-deleteButton deleteButton" style="" onclick="deleteComment(<?= $model->id ?>)">X</button>
                    <span class="comment-date" style="float: right; margin-top: 5px;">
				<? else: ?>
                    <span class="comment-date comment-date-without-delete" style="float: right; margin-top: 5px; margin-right: 32px;">
                <? endif; ?>
                 <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
					<?= Html::dateToString($model->timestamp, 'mediumlong') ?></span>
				<span class="comment-author"><?= Html::link($model->author->fullName, $model->author->viewUrl) ?></span>
			</div>
			<div class="commentContent">
				<?= $model->content ?>
			</div>
		</div>
	</div>
<? endforeach; ?>
