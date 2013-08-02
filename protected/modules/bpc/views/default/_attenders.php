<div id="rightBarContent">
	<div class="g-barTitle">Event</div>
	<div class="g-barText">
		<b>Sted: </b><?= $event->place ?> <br>
		<b>Tid: </b><i><?= Html::dateToString($event->time, 'long') ?></i><br />
	</div>

	<div class="g-barTitle">Påmelding:</div>
	<div class="g-barText">
		<? if (!user()->isGuest): ?>
			<? if ($isAttending): ?>
				<span style="color: green;font-weight: bold">Du er påmeldt</span>
			<? else: ?>
				<span style="color: red;font-weight: bold">Du er ikke påmeldt</span>
			<? endif ?>
			<br/>
		<? endif ?>
		<strong>Påmeldte: </strong> <i><?= $event->this_attending ?> av <?= $event->seats ?></i> <br/>
		<strong>Venteliste: </strong> <i><?= $event->count_waiting ?> av <?= $event->seats ?></i> <br/>
		<strong>Fra: </strong><i><?= Html::dateToString($event->registration_start, 'long') ?></i> <br>
		<strong>Til: </strong><i><?= Html::dateToString($event->deadline, 'long') ?></i> <br>
	</div>

	<div class="g-barTitle">Google kalender</div>
	<div class="g-barText">
		<a href="<?=$event->googleCalendarUrl?>" target="_blank">Legg til i kalender</a>
	</div>
</div>