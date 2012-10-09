<? $this->pageTitle = "Adminpanel nyheter" ?>

<div class="adminView">
    <table>
        <tr>
            <th>Title</th>
            <th>Forfatter</th>
            <th>Dato</th>
            <th>Vekt</th>
            <th>Status</th>
            <th>
        </tr>
        <? foreach ($news as $newsItem): ?>
            <tr>
                <td><?= CHtml::link($newsItem->title, $newsItem->viewUrl) ?></td>
                <td>
                    <? if ($newsItem->author): ?>
                        <?= CHtml::link($newsItem->author->fullName, $newsItem->author->viewUrl) ?>
                    <? endif ?>
                </td>
                <? $time = Html::truncate($newsItem->timestamp, 10, "") ?>
                <td class="date"><time datetime="<?= $time ?>"><?= $time ?></time></td>
                <td><?= $newsItem->weight ?></td>
                <td><?= $newsItem->statusName ?></td>
                <td>
                    <? if (user()->checkAccess('updateNews', array('id' => $newsItem->id))): ?>
                        <?=
                        CHtml::link("Rediger", array("news/edit", 'id' => $newsItem->id), array(
                            'class' => 'g-button'
                        ));
                        ?>
                    <? endif ?>
                </td>
            </tr>
        <? endforeach ?>
    </table>
</div>
