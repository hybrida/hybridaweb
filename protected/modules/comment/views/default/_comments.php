<? foreach ($models as $model): ?>
    <div class="comment">
        <div class="comment-left">
            <div class="profile-image">
                <?= Image::profileTag($model->author->imageId, 'small') ?>
            </div>
        </div>

        <div class="comment-right">
            <div class="comment-title">
                <span class="comment-author"><?= Html::link($model->author->fullName, $model->author->viewUrl) ?></span>
                <span class="comment-date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    11.12.1990</span>
            </div>
            <div class="commentContent">
                <?= $model->content ?>
            </div>
        </div>
    </div>
<? endforeach; ?>