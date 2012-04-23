<? foreach ($models as $model): ?>
<div class="comment">
	<div class="comment-left">
		<div class="profile-image">
                    <? //TODO ?>
		</div>
		<div class="commenter">
			<?= Html::link($model->author->fullName, $model->author->viewUrl) ?>
		</div>
	</div>
	
	<div class="comment-right">
		<div class="commentContent">
			<?= $model->content ?>
		</div>
	</div>
</div>
<? endforeach; ?>