<dropdown data-title='påmeldte'>
<ul>
<? foreach($list as $row) : ?>

            <li>
                <a href='?site=profile&id=<?= $row['userId'] ?>'><?= $row['firstName'] ." ". $row['middleName'] . " " . $row['lastName'] ?></a>
            </li>
            
            

<? endforeach; ?>

</ul></dropdown>
<?= ($signType == "off" /*&& $row['signoff'] == "false" */) ?
"<form data-event_id='" . $id . "' data-sign_type='" . $signType . "'><input name='submit' type='submit' value='" . $buttonText . "' /></form>" : 
""; ?>


