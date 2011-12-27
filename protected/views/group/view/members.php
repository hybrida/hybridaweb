<?php $this->renderPartial("menu", $menu); ?>

<h1>
    <?= $title ?>
</h1>

<h2>Medlemmer </h2>

<table>
    <? foreach($content as $user) : ?>

        <tr>
            <td>
            <img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $user['imageId'] ?>/size/3'>
                <a href='/profile/<?= $user['id'] ?>'> <?= $user['firstName'] ?> <?= $user['middleName'] ?> <?= $user['lastName'] ?> </a>
            </td>
            <td>
                <?= $user['comission'] ?>
            </td>
        </tr>

    <? endforeach ?>
</table>