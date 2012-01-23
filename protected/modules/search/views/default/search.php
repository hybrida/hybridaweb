<? if (isset($users)) : ?>
    <? foreach($users as $user) : ?>

    <?= 
        CHtml::link(
                $user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'],
                array("/profile/view", 'id' => $user['username']));
    ?>

    <!--<a href='<?= $url . $user['username'] ?>/info'><?= $user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'] ?></a>-->
    <?= $split ?>

    <? endforeach ?>
<? endif ?>

<? if (isset($newsList)) : ?>
    <? foreach($newsList as $news) : ?>

        <?= CHtml::link(
                $news['title'] ." ". $news['timestamp'],
                array("/news/view", 'id' => $news['id'], 'title' => $news['title']));
        ?>
        <!--<a title='<?= $news['title'] ." ". $news['timestamp']?>' href='<?= Yii::app()->baseURL . ($news['parentType']==NULL) ? "news" : $news['parentType'] ?>/<?= $news['parentId'] ?>'>
        <?= $news['title'] ?></a>-->

    <? endforeach ?>

<? endif ?>

<a href='#'><i>Avansert søk</i></a>