<?php $this->renderPartial("menu"); ?>
<div id='edit'>
    <a href='<?= Yii::app()->baseURL ?>/article/edit/<?= $id ?>'>endre</a>
</div>

<h1><?= $title ?> </h1>

<p><?=$content?></p>



