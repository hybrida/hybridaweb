<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Oppdaterte elementer</h2>

<? foreach($loginInfo as $info) : ?>
    <p>Sist innlogget: <?= $info['lastLogin'] ?></p>
<? endforeach ?>

<p>Sist oppdatert:</p>

<p>Fjern valgte elementer, velg alle</p>

<p>
<div id="BK-updatedelements-maintablebox">
<table id="BK-updatedelements-maintable">
    <tr>
        <th>Merk</th>
        <th>Tidspunkt</th>
        <th>Beskrivelse</th>
        <th>Oppdatert bedrift</th>
        <th>Oppdatert av</th>
    </tr>
</table>
</div>
</p>