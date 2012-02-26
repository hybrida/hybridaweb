<? if (empty($models)): ?>
    <p>
        Ingen flere nyheter
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
            <?= $model->ingress ?>
            <div class="date"><?= Html::dateToString($model->timestamp, 'long') ?></div>
			<? if ($model->author): ?>
            <div class="author"><?=
				CHtml::link($model->author->fullName, $model->author->viewUrl) ?></div>
			<? endif ?>
        </div>
    </div>
<? endforeach ?>