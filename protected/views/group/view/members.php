<?php $this->renderPartial("menu", $menu); ?>

<h1>
    <?= $title ?>
</h1>

<h2>Medlemmer </h2>

<div id="membertable">
    <table>
        
        <tr>
            <th></th><th>Navn</th><th>Stilling</th><th>Brukernavn</th><th>Telefonnummer</th><th>Sist innlogget</th>
        </tr>
        
        <? foreach($content as $user) : ?>

            <tr>
                <td>
                    <img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $user['imageId'] ?>/size/3'>
                </td>
                <td>
                    <a href='/profile/<?= $user['id'] ?>'> <?= $user['firstName'] ?> <?= $user['middleName'] ?> <?= $user['lastName'] ?> </a>
                </td>
                <td>
                    <?= $user['commission'] ?>
                </td>
                <td>
                    <?= $user['username'] ?>
                </td>
                <td>
                    <?= $user['phoneNumber'] ?>
                </td>
                <td>
                    <?= $user['lastLogin'] ?>
                </td>
            </tr>

        <? endforeach ?>
    </table>
</div>