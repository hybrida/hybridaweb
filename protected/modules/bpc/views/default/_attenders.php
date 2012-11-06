<div id="rightBarContent">
	<div class="g-barTitle">Event</div>
	<div class="g-barText">
		<b>Sted: </b><?= $event->place ?> <br>
		<b>Tid: </b><i><?= Html::dateToString($event->time, 'long') ?></i><br />
	</div>

	<div class="g-barTitle">Påmelding:</div>
	<div class="g-barText">
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