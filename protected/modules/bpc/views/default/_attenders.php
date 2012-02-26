<div id="rightBarContent">
	<div class="barTitle">Event</div>
	<div class="barText">
		<b>Sted: </b><?= $event->place ?> <br>
		<b>Tid: </b><i><?= Html::dateToString($event->time, 'long') ?></i><br />
	</div>

	<div class="barTitle">Påmelding:</div>
	<div class="barText">
		<strong>Påmeldte: </strong> <i><?= $event->this_attending ?> av <?= $event->seats ?></i> <br/>
		<strong>Åpner: </strong><i><?= Html::dateToString($event->registration_start, 'long') ?></i> <br>
		<strong>Stenger: </strong><i><?= Html::dateToString($event->deadline, 'long') ?></i> <br>
	</div>


	<? if (user()->cardinfo == ''): ?>
		<div class="barTitle">Error</div>
		For å melde deg på må du først registrere kortnummeret ditt på
		<?= Html::link('profilredigeringssiden', array('/profile/edit', 'username' => user()->name)) ?> din.
		Deretter må du logge ut og inn.
		<? return; ?>
	<? endif ?>

	<div class="barTitle">Påmeldte</div>
	<div class="barText">
		<? foreach ($event->attending as $user): ?>
			<img src='/image/view/id//size/3 ' >
			<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
			<br>
		<? endforeach; ?>
	</div>

	<div class="barTitle">Venteliste</div>
	<div class="barText">
		<? foreach ($event->waiting as $user): ?>
			<img src='/image/view/id//size/3 ' >
			<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
			<br>
		<? endforeach ?>
	</div>

	<? if ($event->canAttend(user()->id)): ?>
		<?
		if ($event->isAttending(user()->id)) {
			$textString = "Meld meg av";
		} else {
			$textString = "Meld meg på";
		}
		?>
		<?=
		Html::ajaxLink($textString, array('toggleAttending', 'userId' => user()->id, 'bpcId' => $event->id), array(
			'update' => '#rightBarContent',
				), array(
			'class' => 'button',
		))
		?>

	<? else: echo "Kunne ikke melde meg på";
	endif;
	?>
</div>