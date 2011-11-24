<div id='groupNavigation'>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseURL ?>/profile/all/<?= ( $now + 5 ) ?>'>1.klasse</a>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseURL ?>/profile/all/<?= ( $now + 4 ) ?>'>2.klasse</a>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseURL ?>/profile/all/<?= ( $now + 3 ) ?>'>3.klasse</a>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseURL ?>/profile/all/<?= ( $now + 2 ) ?>'>4.klasse</a>
    <a class='groupNavigationItem' href='<?= Yii::app()->baseURL ?>/profile/all/<?= ( $now + 1 ) ?>'>5.klasse</a>
    
</div>

<? foreach($users as $user) : ?>
			<li>
                <img src='<?= Yii::app()->baseURL ?>/image/view/id/<?= $user['imageId'] ?>/size/3 '>
                <a href='<?= Yii::app()->baseURL ?>/profile/id<?= $user['userId'] ?>'><?= $user['firstName'] . " " . $user['middleName'] ." ". $user['lastName'] ?></a>
            </li>
<? endforeach; ?>