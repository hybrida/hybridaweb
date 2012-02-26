<div id="sidebarToBeUpdated">
	<? if ($event): ?>
		<div class="barTitle">Event</div>
		<div class="barText">
			<b>Sted: </b><?= $event->location ?> <br>
			<b>Starter: </b><i><?= Html::dateToString($event->start, 'long') ?></i><br />
			<b>Slutter: </b><i><?= Html::dateToString($event->end, 'long') ?></i>
		</div>

		<? if ($signup): ?>
			<div class="barTitle">Påmelding:</div>
			<div class="barText">
				<strong>Påmeldte: </strong> <i><?= $signup->attendingCount ?> av <?= $signup->spots ?></i> <br/>
				<strong>Åpner: </strong><i><?= Html::dateToString($signup->open, 'long') ?></i> <br>
				<strong>Stenger: </strong><i><?= Html::dateToString($signup->close, 'long') ?></i> <br>
			</div>

			<div class="barTitle">Påmeldte</div>
			<div class="barText">

				<? foreach ($signup->getAttenders() as $user): ?>
					<img src='/image/view/id//size/3 '></img>
					<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
					<br>
				<? endforeach; ?>


				<? if ($signup->canAttend(user()->id)): ?>
					<?=
					Html::ajaxLink($isAttending ? "Meld meg av" : "Meld meg på", array('toggleAttending', 'userId' => user()->id, 'eventId' => $event->id), array(
						'update' => '#sidebarToBeUpdated',
							), array(
						'class' => 'button',
					))
					?>
				<? endif; ?>
			</div>
		<? endif ?>
	<? endif ?>
</div>