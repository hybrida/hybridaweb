<div id='groupNavigation'>
	<?for ($i  = 1; $i <= 5; $i++): ?>
		<?= CHtml::link(
				"$i. klasse",
				array("profile/all", 'id' => ($now + 6-$i)),
				array('class' => 'groupNavigationItem')); 
		?>
	<?endfor; ?>
</div>

<p>
<div id="membertable">
   <table>
        
        <tr>
            <th></th><th>Navn</th><th>Medlemskap</th><th>Spesialisering</th>
        </tr>
        
     <? $counter = 1; ?>

    <? foreach($users as $user) : ?>

        <? if($counter % 2){ ?>
            <tr bgcolor='#CCFFFF'>
        <? }else{ ?>
            <tr bgcolor='#FFFFFF'>
        <? } ?>

            <td><img src='<?= Yii::app()->baseURL ?>/image/view/id/<?= $user['imageId'] ?>/size/3 '></td>
            <td><a href='<?= Yii::app()->baseURL ?>/profile/view/<?= $user['id'] ?>'><?= $user['firstName'] . " " . $user['middleName'] ." ". $user['lastName'] ?></a></td>
            
            <? if($user['member']){ ?>
                <td>Medlem</td>
            <? }else{ ?>
                <td>Ikke medlem</td>
            <? } ?>
            
            <td><a href='<?= Yii::app()->baseURL ?>/#'><?= $user['name'] ?></a></td>
       </tr>

        <? $counter++; ?>

    <? endforeach; ?>
    </table>
</div>
</p>