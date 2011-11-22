<?php $this->renderPartial("menu", $menu); ?>

<h1>
    <?= $title ?>
</h1>

<h2>Medlemmer </h2>


<? foreach($content as $user) : ?>

    <li>
        <img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $user['imageId'] ?>/size/3'>
            <a href='/profile/<?= $user['id'] ?>'> <?= $user['firstName'] ?> <?= $user['middleName'] ?> <?= $user['lastName'] ?> </a> 
            <?= $user['comission'] ?>
    </li>

<? endforeach ?>