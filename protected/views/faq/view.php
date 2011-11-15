<ul>
    F.A.Q
    <? foreach($articles as $article) : ?>

        <li><a href='/yii/article/<?= $article['id'] ?>'><?= $article['title']; ?> </a></li>

    <? endforeach; ?>

</ul>
