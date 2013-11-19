<div class="layout-menu">
	<ul>
		<li><?= CHtml::link("Hjem", array("/newsfeed/index"), array('class' => 'firstNavigationLink')); ?></li>
		<li><?= CHtml::link("Kalender", array("/calendar/default/index")); ?></li>

		<? if (app()->gatekeeper->hasGroupAccess(57)): ?>
			<li>
				<?= CHtml::link("BK", array('/bk/bktool/index')) ?>
				<ul>
					<li><?= CHtml::link('Alumniliste', array('/bk/bktool/graduates')) ?></li>
					<li><?= CHtml::link('Bedriftsoversikt', array('/bk/bktool/companyoverview')) ?></li>
					<li><?= CHtml::link('Bedriftsfordeling', array('/bk/bktool/companydistribution')) ?></li>
					<li><?= CHtml::link('I&IKT-ringen', array('/bk/bktool/industryassociation')) ?></li>
					<li><?= CHtml::link('Kalender', array('/bk/bktool/calendar')) ?></li>
					<li><?= CHtml::link('Om', array('/bk/bktool/index')) ?></li>
					<li><?= CHtml::link('Oppdateringer', array('/bk/bktool/updates')) ?></li>
					<li><?= CHtml::link('Presentasjoner', array('/bk/bktool/presentations')) ?></li>
				</ul>
			</li>

		<? endif ?>

		<li><?= CHtml::link("Bedrift", array("/article/view", 'id' => 2, 'title' => 'Bedrift')); ?></li>
		<li><?= CHtml::link("I&IKT-ringen", array("/article/view", 'id' => 62, 'title' => 'IKT-ringen')); ?></li>
		<li><?= CHtml::link("Om Hybrida", array("/article/view", 'id' => 1, 'title' => 'Om Hybrida')); ?></li>
		<li><?= CHtml::link("Blogg", array("/blog")); ?></li>

		<? if (user()->isGuest): ?>
			<li class="userOptions"><?= CHtml::link("Logg inn", user()->loginUrl) ?></li>
		<? else: ?>
			<? $notificationsCount = Yii::app()->notification->count; ?>
			<li class="userOptions"><?= CHtml::link("Logg ut", param('logoutUrl')); ?></li>
			<li class="userOptions">
				<a href="#">
					<?= user()->firstName ?>
					<? if ($notificationsCount > 0):  ?>
						[<?= $notificationsCount ?>]
					<? endif  ?>
				</a>
				<ul>
					<li class="name"><?= CHtml::link(user()->fullName, array("/profile/")); ?></li>
					<li><?= CHtml::link("Varslinger [" . $notificationsCount . "]", array("/notifications/")); ?></li>
					<li><?= CHtml::link("Medlemmer", array("/students/")); ?></li>
					<li><?= CHtml::link("Forum", array("/forum")) ?></li>
					<li><?= CHtml::link("Kiltbestilling", array("/kilt/")); ?></li>
					<? if (user()->checkAccess('admin')): ?>
						<li><?= CHtml::link("Riddere", array("/knight/")); ?></li>
					<? endif  ?>
				</ul>
			</li>
		<? endif ?>
	</ul>
</div>
<br/>