<div class="layout-menu">
	<ul>
		<li><?= CHtml::link("Hjem", array("/newsfeed/index"), array('class' => 'firstNavigationLink')); ?></li>
		<li><?= CHtml::link("Kalender", array("/calendar/default/index")); ?></li>

		<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
			<li><?= CHtml::link("BK", array('/bk/bktool/index')) ?></li>
		<? endif ?>

		<? if (!user()->isGuest): ?>
		<? endif ?>

		<li><?= CHtml::link("Bedrift", array("/article/view", 'id' => 2, 'title' => 'Bedrift')); ?></li>
		<li><?= CHtml::link("I&IKT-ringen", array("/article/view", 'id' => 62, 'title' => 'IKT-ringen')); ?></li>
		<li><?= CHtml::link("Om Hybrida", array("/article/view", 'id' => 1, 'title' => 'Om Hybrida')); ?></li>

		<? if (user()->isGuest): ?>
			<li class="userOptions"><?= CHtml::link("Logg inn", user()->loginUrl) ?></li>
		<? else: ?>
			<li class="userOptions"><?= CHtml::link("Logg ut", param('logoutUrl')); ?></li>
			<li class="userOptions">
				<a href="#">
					<?= user()->firstName ?>
				</a>
				<ul>
					<li class="name"><?= CHtml::link(user()->fullName, array("/profile/")); ?></li>
					<li><?= CHtml::link("Varslinger", array("/notifications/")); ?></li>
					<li><?= CHtml::link("Medlemmer", array("/students/")); ?></li>
					<li><?= CHtml::link("Forum", array("/forum")) ?></li>
					<li><?= CHtml::link("Kiltbestilling", array("/kilt/")); ?></li>
				</ul>
			</li>
		<? endif ?>
	</ul>
</div>
<br/>