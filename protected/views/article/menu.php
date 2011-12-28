<? if(isset($menuelements)) : ?>
    
<div id='groupNavigation'>
    <? foreach($menuelements as $element) : ?>
        <a class='groupNavigationItem' href='<?= Yii::app()->baseUrl ?>/article/view/<?= $id ?>/<?= $element['title'] ?>'><?= $element['title']?></a>
    <? endforeach; ?>

    <? if($isAdmin) : ?>
        <a class='groupNavigationItem' href='<?= Yii::app()->baseUrl ?>/article/edit/<?= $id ?>'>endre</a>
    <? endif; ?>
</div>

<? endif; ?>

<div id='groupNavigation'>
    <a class='groupNavigationItem' href=''>Styret</a>
    <a class='groupNavigationItem' href=''>Kontakt</a>
    <a class='groupNavigationItem' href=''>Statutter</a>
    <a class='groupNavigationItem' href=''>Internavis</a>
</div>