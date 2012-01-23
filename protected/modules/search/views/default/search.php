<? if (isset($users)) : ?>
    <? foreach($users as $user) : ?>


    <a href='<?= $url . $user['userId'] ?>'><?= $user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'] ?></a>
    <?= $split ?>

    <? endforeach ?>
<? endif ?>

<? if (isset($newsList)) : ?>
    <? foreach($newsList as $news) : ?>

        <a title='<?= $news['title'] ." ". $news['timestamp']?>' href='<?= Yii::app()->baseURL . ($news['parentType']==NULL) ? "news" : $news['parentType'] ?>/<?= $news['parentId'] ?>'>
        <?= $news['title'] ?></a>

    <? endforeach ?>

<? endif ?>

<a href='#'><i>Avansert søk</i></a>