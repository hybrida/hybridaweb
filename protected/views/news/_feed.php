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
            <div class="date">Dato: <?= Html::dateToString($model->timestamp) ?></div>
			<? if ($model->author): ?>
            <div class="author"><?=
				CHtml::link($model->author->fullName, array(
					"/profile/view/", 
					"username" => $model->author->username,
				)) ?></div>
			<? endif ?>
        </div>
    </div>
<? endforeach ?>