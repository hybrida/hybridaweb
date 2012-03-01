<? if (empty($models)): ?>
    <p>
        Ingen flere artikler
    </p>
    <? return; ?>
<? endif; ?>

<? foreach ($models as $model): ?>
    <div class="contentItem">
        <div class="blueBox">
            <div class="blueBoxItem"></div>
        </div>
        <div class="topBar">
            <div class="topBarItem"></div>
            <h1><?= CHtml::link($model->title, $model->viewUrl) ?></h1>
        </div>
        <div class="articleContent">
            <?= $model->content ?>
            <div class="date"><?= Html::dateToString($model->timestamp, 'medium') ?></div>
			<? if ($model->author): ?>
            <div class="author"><?=
				CHtml::link($model->authorName, $model->authorUrl) ?></div>
			<? endif ?>
        </div>
    </div>
<? endforeach ?>