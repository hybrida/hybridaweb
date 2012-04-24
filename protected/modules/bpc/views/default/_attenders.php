<div id="rightBarContent">
	<div class="barTitle">Event</div>
	<div class="barText">
		<b>Sted: </b><?= $event->place ?> <br>
		<b>Tid: </b><i><?= Html::dateToString($event->time, 'long') ?></i><br />
	</div>

	<div class="barTitle">Påmelding:</div>
	<div class="barText">
		<strong>Påmeldte: </strong> <i><?= $event->this_attending ?> av <?= $event->seats ?></i> <br/>
		<strong>Fra: </strong><i><?= Html::dateToString($event->registration_start, 'long') ?></i> <br>
		<strong>Til: </strong><i><?= Html::dateToString($event->deadline, 'long') ?></i> <br>
	</div>
</div>