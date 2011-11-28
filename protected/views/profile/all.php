<div id='groupNavigation'>
	<?for ($i  = 1; $i <= 5; $i++): ?>
		<?= CHtml::link(
				"$i. klasse",
				array("profile/all", 'id' => ($now + 6-$i)),
				array('class' => 'groupNavigationItem')); 
		?>
	<?endfor; ?>
</div>

<? foreach($users as $user) : ?>
	<li>
		<img src='<?= Yii::app()->baseURL ?>/image/view/id/<?= $user['imageId'] ?>/size/3 '>
		<a href='<?= Yii::app()->baseURL ?>/profile/view/<?= $user['id'] ?>'><?= $user['firstName'] . " " . $user['middleName'] ." ". $user['lastName'] ?></a>
	</li>
<? endforeach; ?>