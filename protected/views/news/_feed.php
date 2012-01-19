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
            
            <? $url = $this->createUrl("/news/edit", array("id" => $model->id)); ?>
            <!--
            <div align="right">
                <? $url = $this->createUrl("/news/edit", array("id" => $model->id)); ?>
                <a href="<?= $url ?>">
                    <img height='20' src="/images/icons/edit.png"/>
                </a>
            </div>
            -->
			<? if (!user()->isGuest): ?>
				<a class="button buttonRightSide" href="<?= $url ?>">Rediger</a>
            <? endif ?>
            <?= $model->content ?>
            <div class="date">Dato: <?= $model->timestamp ?></div>
            <div class="author"><?=
        CHtml::link($model->authorName, array("/profile/view/", "id" => $model->author))
            ?></div>
        </div>
    </div>
<? endforeach ?>