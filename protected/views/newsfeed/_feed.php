<? if (empty($news)): ?>
	<p>
		Ingen flere nyheter
	</p>
	<? return; ?>
<? endif; ?>

<div id="news">
    <? foreach ($news as $newsItem): ?>
        <div class="element">
            <div class="header-wrapper">
                <div class="header-title">
                    <h1><?= CHtml::link($newsItem->title, $newsItem->viewUrl) ?></h1>
                </div>
                <div class="header-date">

                </div>
            </div>
            <div class="text-content">
                <? if ($newsItem->imageId): ?>
                    <a href="<?= $newsItem->viewUrl ?>">
                        <?= Image::tag($newsItem->imageId, 'frontpage') ?>
                    </a>
                <? endif ?>
                <?= $newsItem->ingress ?>
                <? if ($newsItem->author): ?>
                    <div class="author">
                        <?= CHtml::link($newsItem->author->fullName, $newsItem->author->viewUrl) ?>
                        den
                        <span class="date">
                            <?= Html::dateToString($newsItem->timestamp, 'mediumlong') ?>
                        </span>
                    </div>
                <? else: ?>
                    <div class="author">
                        Hybrida
                        den
                        <span class="date">
                            <?= Html::dateToString($newsItem->timestamp, 'mediumlong') ?>
                        </span>
                    </div>
                <? endif?>

            </div>
        </div>
    <? endforeach ?>
</div>
    
<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#news',
    'itemSelector' => 'div.element',
    'loadingText' => 'Sigbjørn jobber med å skrive flere nyheter...',
    'donetext' => 'Sigurd kunne ikke finne flere nyheter...',
    'pages' => $pages,
)); ?>
