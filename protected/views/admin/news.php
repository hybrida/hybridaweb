<? $this->pageTitle = "Adminpanel nyheter" ?>

<div class="adminView">
    <table>
        <tr>
            <th>Title</th>
            <th>Forfatter</th>
            <th>Dato</th>
            <th class="admin-ingress">Ingress</th>
            <th>Status</th>
            <th>Vekt</th>
            <th>Rediger</th>
        </tr>
        <? foreach ($news as $newsItem): ?>
            <tr>
                <td><?= CHtml::link($newsItem->title, $newsItem->viewUrl) ?></td>
                <td>
                    <? if ($newsItem->author): ?>
                        <?= CHtml::link($newsItem->author->fullName, $newsItem->author->viewUrl) ?>
                    <? endif ?>
                </td>
                <td><?= $newsItem->timestamp ?></td>
                <td><?= Html::truncate($newsItem->ingress, 100, "...") ?></td>
                <td><?= $newsItem->statusName ?></td>
                <td><?= $newsItem->weight ?></td>
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
        </tbody>
    </table>
</div>
