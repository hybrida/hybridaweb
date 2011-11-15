<? foreach($menuelements as $element) : ?>

<a href='<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/<?= $element['title'] ?>'><?= $element['title']?></a>

<? endforeach; ?>

<? if($isAdmin) : ?>

<a href='<?= Yii::app()->baseUrl ?>/group/edit/<?= $id ?>'>endre</a>

<? endif; ?>


