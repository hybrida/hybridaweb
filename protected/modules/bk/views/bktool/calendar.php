<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <h1><?= $this->title ?></h1>
</h1>

<h2>Google Calendar</h2>

<p>Google Calendar for <?= $this->organisationName ?>. Kalenderen viser planlagte hendelser for hele <?= $this->organisationName ?>.</p>

<iframe src="https://www.google.com/calendar/embed?src=qiosf3me88g5l6tlp94rsh74a4%40group.calendar.google.com&ctz=Europe/Oslo" style="border: 0" width="100%" height="75%" frameborder="2" scrolling="yes">
</iframe>