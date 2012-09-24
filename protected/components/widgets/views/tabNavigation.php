<div class="navItems">
	<div><?= CHtml::link("Forsiden", array("/newsfeed/index")); ?></div> 
	<div><?= CHtml::link("Kalender", array("/calendar/default/index")); ?></div> 

	<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
	  <div><?= CHtml::link("BK", array('/bk/bktool/index')) ?> </div>
	  <? endif ?>

	  <? if (!user()->isGuest): ?>
	  <div><?= CHtml::link("Profil", array("/profile/")); ?></div>
	  <div><?= CHtml::link("Medlemmer", array("/students/")); ?></div>
	  <div><?= CHtml::link("Kilt", array("/kilt/shop/index")); ?></div>
	  <? endif ?>

	<div><?= CHtml::link("Bedrift", array("/article/view", 'id' => 2, 'title' => 'Bedrift')); ?></div> 
	<div><?= CHtml::link("I&IKT-ringen", array("/article/view", 'id' => 62, 'title' => 'IKT-ringen')); ?></div>
	<div><?= CHtml::link("Om Hybrida", array("/article/view", 'id' => 1, 'title' => 'Om Hybrida')); ?></div>
	<? Yii::import('notifications.models.*') ?>

	<? if (user()->isGuest): ?>
		<div><?= CHtml::link("Logg inn", user()->loginUrl) ?></div>
	<? else: ?>
		<div class="widget-notification">
			<? $url = app()->createUrl('notifications/default/index') ?>
			<a href="<?= $url ?>">
				<?= count(Notifications::getUnread(user()->id)) ?>
			</a>
		</div>
		<div>
			<?= CHtml::link(user()->fullName, param('logoutUrl'));
			?>
		</div>
	<? endif ?>
</div>
