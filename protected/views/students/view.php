<? $this->pageTitle = "Klasseliste " . $graduationYear ?>


<div id='groupNavigation'>
	<?=
	CHtml::link(
			"1. klasse", array("students/view", 'id' => 2016), array('class' => 'groupNavigationItem'));
	?>
	<?=
	CHtml::link(
			"2. klasse", array("students/view", 'id' => 2015), array('class' => 'groupNavigationItem'));
	?>
	<?=
	CHtml::link(
			"3. klasse", array("students/view", 'id' => 2014), array('class' => 'groupNavigationItem'));
	?>
	<?=
	CHtml::link(
			"4. klasse", array("students/view", 'id' => 2013), array('class' => 'groupNavigationItem'));
	?>
	<?=
	CHtml::link(
			"5. klasse", array("students/view", 'id' => 2012), array('class' => 'groupNavigationItem'));
	?>
</div>


<table id="membertable">
    <tr>
        <th></th><th>Navn</th><th>Medlemskap</th><th>Spesialisering</th>
    </tr>
	<? $odd = false ?>
	<? foreach ($users as $user) : ?>
		<? $odd = !$odd ?>
		<div class="<?= $odd ? "odd" : "like" ?>" >
	        <tr>
	            <td class="imageCell"><img src='<?= Yii::app()->baseURL ?>/image/view/id/<?= $user['imageId'] ?>/size/3 '></td>
	            <td class="nameCell"><?= CHtml::link($user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'], array('/profile/info', 'username' => $user['username'])) ?></a></td>

	            <td class="isMemberCell">
					<? if ($user['member']) { ?>
						Medlem
					<? } else { ?>
						Ikke medlem
					<? } ?>
	            </td>

	            <td><a href='<?= Yii::app()->baseURL ?>/#'><?= $user['name'] ?></a></td>
	        </tr>
		</div>
	<? endforeach; ?>
</table>