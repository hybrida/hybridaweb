<items>
	<div><?= CHtml::link("Forsiden", "/"); ?></div> 

	<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
		<div><?= CHtml::link("BK", array('/bk/bktool/index')) ?> </div>
	<? endif ?>

	<? if (!user()->isGuest): ?>
		<div><?= CHtml::link("Profil", array("/profile/")); ?></div>
		<div><?= CHtml::link("Medlemmer", array("/students/")); ?></div> 
	<? endif ?>

	<div><?= CHtml::link("Bedrift", array("/article/view", 'id' => 2, 'title' => 'Bedrift')); ?></div> 
	<div><?= CHtml::link("Om Hybrida", array("/article/view", 'id' => 1, 'title' => 'Om Hybrida')); ?></div>
</items>