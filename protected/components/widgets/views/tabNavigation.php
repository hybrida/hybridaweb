<div class="navItems">
	<?= CHtml::link("Hjem", array("/newsfeed/index")); ?> 
	<?= CHtml::link("Kalender", array("/calendar/default/index")); ?> 

	<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
		<?= CHtml::link("BK", array('/bk/bktool/index')) ?> 
	<? endif ?>

	<? if (!user()->isGuest): ?>
		<?= CHtml::link("Profil", array("/profile/")); ?> 
		<?= CHtml::link("Medlemmer", array("/students/")); ?> 
	<? endif ?>

	<?= CHtml::link("Bedrift", array("/article/view", 'id' => 2, 'title' => 'Bedrift')); ?> 
	<?= CHtml::link("I&IKT-ringen", array("/article/view", 'id' => 62, 'title' => 'IKT-ringen')); ?> 
	<?= CHtml::link("Om Hybrida", array("/article/view", 'id' => 1, 'title' => 'Om Hybrida')); ?> 
	<? Yii::import('notifications.models.*') ?>

	<div class="userOptions">
		<? if (user()->isGuest): ?>
			<?= CHtml::link("Logg inn", user()->loginUrl) ?>
		<? else: ?>
			<?= CHtml::link("Logg ut", param('logoutUrl')); ?>
		<? endif ?>
	</div>

</div>