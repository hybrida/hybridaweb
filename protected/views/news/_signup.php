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
	<? endif ?>
	
	<h1> Påmeldte: </h1>
	<?= Html::userListByYear($signup->attendersFiveYearArrays) ?>
<? endif ?>