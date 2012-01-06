<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<? foreach($companyContactInfo as $info) : ?>
    <h2><?= $info['companyName'] ?></h2>
<? endforeach ?>

<p>
<table id="BK-company-maintable">
    <tr>
        <td>
            <h3>Informasjon</h3>
        </td>
        <td>
            <h3>Bedriftspresentasjoner</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h4>Rediger bedrift</h4>
        <td>
            <h4>Fjern bedrift</h4>
        </td>    
    </tr>
    <tr>
        <td>
            <h3>Kommentarer</h3>
        </td>
        <td>
            <h3>Alumnistudenter</h3>
        </td>
    </tr>
</table>
</p>