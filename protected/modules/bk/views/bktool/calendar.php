<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <h1><?= $this->title ?></h1>
</h1>

<h2>Google Calendar</h2>

<p>
    Google Calendar for <?= $this->organisationName ?>. Kalenderen viser planlagte hendelser for hele <?= $this->organisationName ?> 
    og større arrangementer av andre næringslivsorganisasjoner på NTNU. Kalenderen fungerer best i Google Chrome.</p>
<div id="BK-calendar">
    <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=qiosf3me88g5l6tlp94rsh74a4%40group.calendar.google.com&amp;color=%23182C57&amp;src=nt0dghcasms4lt5tqs9s9gi26o%40group.calendar.google.com&amp;color=%232F6309&amp;ctz=Europe%2FOslo" style=" border-width:0 " width="100%" height="700px" frameborder="0" scrolling="yes">
    </iframe>
</div>