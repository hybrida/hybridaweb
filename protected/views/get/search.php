<? foreach($users as $user) : ?>

			
<a href='<?= Yii::app()->baseUrl ?>/profile/<?= $user['userId'] ?>'><?= $user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'] ?></a>
<?= $split ?>
			            
<? endforeach ?>


<? foreach($newsList as $news) : ?>

    <a title='<?= $news['title'] ." ". $news['timestamp']?>' href='?site=<?= ($news['parentType']==NULL) ? "news" : $news['parentType'] ?>&id=<?= $news['parentId'] ?>'>
    <?= $news['title'] ?></a>

<? endforeach ?>


<a href='#'><i>Avansert søk</i></a>