<?php $this->renderPartial("menu", $menu); ?>

<?
    /**
     * Side for alumni
     *
     * @author frans
     */
?>

<h1>
    <?= $title ?>
</h1>

<h2>Alumni</h2>

<p>
    Alumnilisten er listen over alle studenter som er uteksaminert fra Ingeniørvitenskap og IKT, og hvor de har blitt ansatt rett etter studiet. Statistikken under er ikke nødvendigvis korrekt, da oversikten gitt her kan være mangelfull.
</p>

<p><h3>Statistikk:</h3>

<p>
    <table id="BK-alumnilist-supporttable">
        <tr>
            <td>Årsstatistikk</td>
            <td>Ansettelsesstatistikk</td>
            <td>Valg</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Legg til alumni</td>
        </tr>
    </table>
</p>

<p><h3>Alumnistudenter:</h3>

<p>
    <table id="BK-alumnilist-maintable">
        <tr>
            <th>Navn</th>
            <th>Privatmail</th>
            <th>Uteksamineringsår</th>
            <th>Studieretning</th>
            <th>Bedrift</th>
            <th>Stillingsbeskrivelse</th>
            <th>Arbeidssted</th>
            <th>Rediger</th>
    </table>
</p>