<?php $this->renderPartial("menu", $menu); ?>

<?
    /**
     * Side for bedrifter
     *
     * @author frans
     */
?>

<h1>
    <?= $title ?>
</h1>

<h2>Bedriftsoversikt</h2>

<p>Bedriftsoversikten er oversikten over alle bedrifter som Hybrida Bedriftskomité er, og har vært, i kontakt med.</p>

<div id="BK-companyoverview-container">
<p>
    <table id="BK-companyoverview-supporttable">
        <tr>
            <th>Statistikk:</th>
            <th>Valg:</th>
        </tr>
        <tr>
            <td>
                <table id="BK-companyoverview-statisticstable">

                </table>
            </td>
            <td>
                <table id="BK-companyoverview-selectiontable">
                    <tr><td>Fordeling av bedrifter</td></tr>
                    <tr><td>Legg til bedrift</td></tr>
                    <tr><td>Legg til bedriftspresentasjon</td></tr>
                </table>
            </td>
        </tr>
    </table>
</p>

<p><h3>Bedrifter:</h3></p>

<p>
    <table id="BK-companyoverview-maintable">
        <tr>
            <th>Bedrift</th>
            <th>Status</th>
            <th>Kontaktet av</th>
            <th>Dato lagt til</th>
            <th>Lagt til av</th>
        </tr>
    </table>
</p>
</div>