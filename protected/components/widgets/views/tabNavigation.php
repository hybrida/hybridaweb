<items>
	<div><?= CHtml::link("Forsiden", array("/news/feed")); ?></div> 

	<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
		<div><?= CHtml::link("BK", array('/bk/bktool/index')) ?> </div>
	<? endif ?>

	<? if (!user()->isGuest): ?>
		<div><?= CHtml::link("Profil", array("/profile/")); ?></div>
		<div><?= CHtml::link("Medlemmer", array("/students/")); ?></div> 
	<? endif ?>

	<div><?= CHtml::link("Bedrift", array("/article/2")); ?></div> 
	<div><?= CHtml::link("Om Hybrida", array("/article/1")); ?></div>
</items>