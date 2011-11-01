<h1><?= $title ?></h1>

<?php $this->renderPartial("menu"); ?>

<h2>Medlemmer </h2>


<? foreach($content as $user) : ?>

    <li>
        <img src='php/image/id/<?= $user['imageId'] ?>/size/3'>
            <a href='/profile/<?= $user['id'] ?>'> <?= $user['firstName'] ?> <?= $user['middleName'] ?> <?= $user['lastName'] ?> </a> 
            <?= $user['comission'] ?>
    </li>

<? endforeach ?>