<items>
	<div><?= CHtml::link("Forsiden", array("/news/feed")); ?></div> 
	<div><?= CHtml::link("Hybrida", array("/article/1")); ?></div>
	<div><?= CHtml::link("Bedrift", array("/article/2")); ?></div> 
	<? if (!user()->isGuest): ?>
	<div><?= CHtml::link("Profil", array("/profile/")); ?></div>
	<div><?= CHtml::link("Personer", array("/students/")); ?></div> 
	<? endif ?>
	<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
	<div><?= CHtml::link("BK", array('/bk/bktool/index')) ?> </div>
	<? endif ?>
</items>