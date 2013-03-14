<?/*

 * Her er alle css-tags prefixet med en c-. Dette er for å unngå
 * navnkonflikter fra views lenger oppe.

 */ ?>

<? foreach ($models as $model): ?>
	<div class="c-comment comment-<?= $model->id ?>">
		<a name="comment-<?= $model->id ?>"></a>
		<div class="c-profileImage">
			<?= Image::profileTag($model->author->imageId, 'xsmall') ?>
		</div>

		<div class="c-right">
			<div class="c-header">
				<div class="c-author"><?= Html::link($model->author->fullName, $model->author->viewUrl) ?></div>
				<? if ($model->hasDeleteAccess()): ?>
					<button
						class="c-deleteButton"
						onclick="deleteComment(<?= $model->id ?>)"
							>x</button>
                    <div class="c-date">
				<? else: ?>
                    <div class="c-date c-date-without-delete">
                <? endif; ?>
						<?= Html::dateToString($model->timestamp, 'mediumlong') ?>
					</div>
			</div>
			<div class="c-content">
				<?= $model->content ?>
			</div>
		</div>
	</div>
<? endforeach; ?>
