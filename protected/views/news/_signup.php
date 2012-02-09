<div id="signup_attending">
	<? if (user()->cardinfo == ''): ?>
		For å melde deg på må du først registrere kortnummeret ditt på
		<?= Html::link('profilredigeringssiden', array('/profile/edit', 'username' => user()->name)) ?> din.
		Deretter må du logge ut og inn.
		<? return; ?>
	<?endif ?>
		
		
	<? foreach ($signup->getAttenders() as $user): ?>
		<img src='/image/view/id//size/3 '></img>
		<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
		<br>
	<? endforeach; ?>
		
		
	<? if ($signup->canAttend(user()->id)): ?>
		<?=
		Html::ajaxLink("Meld meg på", array('toggleAttending', 'userID' => user()->id, 'eventID' => $signup->eventId), array(
			'update' => '#signup_attending',
				), array(
			'class' => 'button',
		))
		?>
	<? endif ?>
		
		
	<? if ($signup->canUnattend(user()->id)): ?>
		<?=
		Html::ajaxLink("Meld meg av", array('toggleAttending', 'userID' => user()->id, 'eventID' => $signup->eventId), array(
			'update' => '#signup_attending',
				), array(
			'class' => 'button',
		))
		?>
		
<? endif ?>
</div>