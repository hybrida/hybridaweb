
<items>
	<div><?=CHtml::link("Hjem",array("/")); ?></div>
	<div><?=CHtml::link("EventEndring",array("event/"))?></div>
	<div><?=CHtml::link("Profil",array("profil/")); ?></div>

	<? if (Yii::app()->user->isGuest == true): ?>
	<div><?=CHtml::link("Logg inn",array("site/login")); ?></div>
	<? else: ?>
	<div><?=CHtml::link("Logg ut",array("site/logout")); ?></div>
	<? endif; ?>
</items>