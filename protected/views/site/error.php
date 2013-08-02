<div class="siteError">

<h1>  <?= $code; ?></h1>

<? if ($code == 404): ?>
<? $message = "hybrida.no" . $_SERVER['REQUEST_URI'] ?>
	<p id="text">Du forsøkte å nå</p>
<? endif; ?>

<div class="message">
	<?php echo CHtml::encode($message); ?>
</div>

<? if ($code == 404): ?>
	<p id="text">Men siden eksisterer ikke</p>
	<ul>
	<li>Sjekk at du har skrevet inn riktig adresse</li>
	<li>Hvis du fulgte en død link, vær vennlig å rapportere dette ved å bruke feedback-knappen til venstre</li>
	</ul>
<? endif; ?>

<? if (user()->isGuest && $code != 404): ?>
	<p id="logginn">Du må være logget inn for å se denne siden</p>
<? endif; ?>

</div>
