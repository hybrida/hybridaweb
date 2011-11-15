<button data-id='<?= $id ?>' data-type='<?= $signType ?>'><?= $buttonText ?></button>
<dropdown data-title='påmeldte'>
<ul>
<? foreach($list as $row) : ?>

            <li>
                <a href='?site=profile&id=<?= $row['userId'] ?>'><?= $row['firstName'] ." ". $row['middleName'] . " " . $row['lastName'] ?></a>
            </li>

<? endforeach; ?>
</ul></dropdown>

