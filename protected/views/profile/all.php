<div id='groupNavigation'>
		<?= CHtml::link(
				"1. klasse",
				array("profile/all", 'id' => 2016),
				array('class' => 'groupNavigationItem')); ?>
		<?= CHtml::link(
				"2. klasse",
				array("profile/all", 'id' => 2015),
				array('class' => 'groupNavigationItem')); ?>
		<?= CHtml::link(
				"3. klasse",
				array("profile/all", 'id' => 2014),
				array('class' => 'groupNavigationItem')); ?>
		<?= CHtml::link(
				"4. klasse",
				array("profile/all", 'id' => 2013),
				array('class' => 'groupNavigationItem')); ?>
		<?= CHtml::link(
				"5. klasse",
				array("profile/all", 'id' => 2012),
				array('class' => 'groupNavigationItem')); ?>
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