<? if ($event): ?>
	<div class="barTitle">Event</div>
	<div class="barText">
		<b>Sted: </b><?= $event->location ?> <br>
		<b>Fra: </b><i><?= Html::dateToString($event->start, 'long') ?></i><br />
		<b>Til: </b><i><?= Html::dateToString($event->end, 'long') ?></i>
	</div>

	<? if ($signup): ?>
		<div class="barTitle">Påmelding:</div>
		<div class="barText">
			<strong>Påmeldte: </strong> <i><?= $signup->attendingCount ?> av <?= $signup->spots ?></i> <br/>
			<strong>Fra: </strong><i><?= Html::dateToString($signup->open, 'long') ?></i> <br>
			<strong>Til: </strong><i><?= Html::dateToString($signup->close, 'long') ?></i> <br>
		</div>
	<? endif ?>
	<div class="barTitle">Google calendar</div>
	<div class="barText">
		<?= $event->getGoogleCalendarButton() ?>
	</div>

<? endif ?>
