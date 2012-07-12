<? foreach ($models as $model): ?>
    <div class="comment">
		<a name="comment-<?=$model->id?>" />
        <div class="comment-left">
            <div class="profile-image">
                <?= Image::profileTag($model->author->imageId, 'small') ?>
            </div>
        </div>

        <div class="comment-right">
            <div class="comment-title">
                <span class="comment-author"><?= Html::link($model->author->fullName, $model->author->viewUrl) ?></span>
                <span class="comment-date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?= Html::dateToString($model->timestamp, 'long') ?></span>
            </div>
            <div class="commentContent">
                <?= $model->content ?>
			<? if ($model->hasDeleteAccess()): ?>
				<button onclick="deleteComment(<?=$model->id?>)">Slett</button>
			<? endif; ?>
            </div>
        </div>
    </div>
<? endforeach; ?>