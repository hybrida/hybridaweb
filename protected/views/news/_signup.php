<h1> Påmeldte: </h1>
<? if (user()->isGuest): ?>
	<p>
		Du må logge inn for å se listen over påmeldte
	</p>
<? else: ?>
	<?= Html::userListByYear($signup->attendersFiveYearArrays) ?>
	
	<? $url = $this->createUrl('toggleAttending', array('eventId' => $signup->eventId)) ?>
	<? if (!$isAttending && $signup->canAttend(user()->id)): ?>
		<a href="<?= $url ?>" class='g-button'>Meld meg på</a>
	<? elseif ($isAttending && $signup->canUnattend()): ?>
		<a href="<?= $url ?>" class='g-button'>Meld meg av</a>
	<? endif ?>
<? endif ?>