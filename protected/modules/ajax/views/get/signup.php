<button class="button" data-id='<?= $id ?>' data-type='<?= $signType ?>'><?= $buttonText ?></button>
<dropdown data-title='påmeldte'>
<ul>
<? foreach($list as $row) : ?>

            <li>
                <img src='<?= Yii::app()->baseURL ?>/image/view/id/<?= $row['imageId'] ?>/size/3 '></img>
                <a href='<?= Yii::app()->baseURL ?>/profile/<?= $row['userId'] ?>'><?= $row['firstName'] ." ". $row['middleName'] . " " . $row['lastName'] ?></a>
            </li>

<? endforeach; ?>
</ul></dropdown>

