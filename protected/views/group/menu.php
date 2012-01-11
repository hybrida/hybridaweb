<div id='groupNavigation'>
    <? foreach($menuelements as $element) : ?>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/<?= $element['title'] ?>'><?= $element['title']?></a>
    <? endforeach; ?>

    <? if($isAdmin) : ?>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseUrl ?>/group/edit/<?= $id ?>'>Endre</a>
    <? endif; ?>
</div>