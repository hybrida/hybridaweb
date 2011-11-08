<? /*($signType == "off" /*&& $row['signoff'] == "false" )*/ ?>

<button data-id='<?= $id ?>'><?= $buttonText ?></button>

<dropdown data-title='påmeldte'>
<ul>
<? foreach($list as $row) : ?>

            <li>
                <a href='?site=profile&id=<?= $row['userId'] ?>'><?= $row['firstName'] ." ". $row['middleName'] . " " . $row['lastName'] ?></a>
            </li>

<? endforeach; ?>
<?=  rand(0,10) ?>
</ul></dropdown>

