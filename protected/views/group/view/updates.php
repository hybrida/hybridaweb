<?php $this->renderPartial("menu", $menu); ?>

<?
    /**
     * Side for oppdaterte elementer
     *
     * @author frans
     */
?>

<h1>
    <?= $title ?>
</h1>

<h2>Oppdaterte elementer</h2>

<p>Sist innlogget:</p>

<p>Sist oppdatert:</p>

<p>Fjern valgte elementer, velg alle</p>

<p>
<table id="BK-updatedelements-maintable">
    <tr>
        <th>Merk</th>
        <th>Tidspunkt</th>
        <th>Beskrivelse</th>
        <th>Oppdatert bedrift</th>
        <th>Oppdatert av</th>
    </tr>
</table>
</p>