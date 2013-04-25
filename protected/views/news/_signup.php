<? if (user()->isGuest): ?>
	<h1> Påmeldte: </h1>
	<p>
		Du må logge inn for å se listen over påmeldte
	</p>
<? else: ?>
	<? $url = $this->createUrl('toggleAttending', array('eventId' => $signup->eventId)) ?>
	<? if (!$isAttending && $signup->canAttend(user()->id)): ?>
		<a href="<?= $url ?>" class='g-button'>Meld meg på</a>
	<? elseif ($isAttending && $signup->canUnattend()): ?>
		<a href="<?= $url ?>" class='g-button'>Meld meg av</a>
	<? elseif (!$isAttending && !$hasAccessToSignup): ?>
		<input type ="button" class='g-button' disabled="disabled" value ="Meld meg på"</input>
		<p>Du har ikke tilgang til denne hendelsen</p>
		
	<? endif ?>
<? endif ?>
		
<? if ($hasAccessToSignup): ?>
		<h1> Påmeldte: (<?= $signup->getRegisteredAttendingCount() ?>)</h1>
		<?= Html::userListByYear($signup->attendersFiveYearArrays) ?>

	<h2>Andre påmeldte: (<?= $signup->getAnonymousAttendingCount() ?>)</h2>
	<div class="manualAttenders">
		<? foreach ($signup->getAnonymousAttenders() as $attender): ?>
		<ul class="attender">
			<li class="name"><?= $attender->fullName ?></li>
		</ul>
		<? endforeach ?>
	</div>
<? endif ?>