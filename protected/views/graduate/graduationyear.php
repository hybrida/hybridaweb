<?php

$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); ?>
<div id="BK-alumnilist-selectionlist">
    <ul>
        <li><b><?= CHtml::link('Alumnioversikt', array('graduate/index')) ?></b></li>
        <li><b>Tidligere klassekull</b></li>
        <li>
            <ul>
                <? foreach($graduationYears as $year) : ?>
                     <li><?=CHtml::link($year['graduationYear'], array('graduationyear', 'id' => $year['graduationYear']))?></li>
                <? endforeach ?>
            </ul>
        </li>
    </ul>
</div>
<?
$this->endClip();
?>

<h2>Alumniliste for uteksamineringsår <?= $graduationyear ?></h2>

<h3>Alumnistudenter i bedrifter:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
	<td>
            <div id="BK-alumnilist-companybox">
                <table id="BK-alumnilist-companytable">
                    <tr>
                        <th>Nr.</th><th>Bedrift</th><th>Antall registrert ansatte alumnistudenter</th>
                    </tr>
                    <? $counter = 1; ?>
                    <? foreach($employingCompaniesByYear as $company) : ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $company['companyName'] ?></td>
                            <td><?= $company['sum'] ?></td>
                        </tr>
                        <? $counter++; ?>
                    <? endforeach ?>
                </table>
            </div>
	</td>
    </tr>
    <tr>
	<th id="BK-alumnilist-cumulationrow">
            <? foreach($employeesSumByYear as $employeeSum) : ?>
                Sum registrert ansatte alumnistudenter: <?= $employeeSum['sum'] ?>
            <? endforeach ?>
        </th>
    </tr>
</table>
</p>

<br/>
<? foreach($graduatesSumByYear as $graduateSum) : ?>
      <h3>Alle studenter med uteksamineringsår <?= $graduationyear ?> (<?= $graduateSum['sum'] ?>):</h3>
<? endforeach ?>

<p>
<table id="BK-alumnilist-maintable">
    <? foreach($graduatesSumByYear as $graduateSum) : ?>
        <tr>
            <th></th>
            <th>Navn</th>
            <th>Spesialisering</th>
            <th>Bedrift</th>
            <th>Stillingsbeskrivelse</th>
            <th>Arbeidssted</th>
        </tr>
      
    <? endforeach ?>

    
    <? foreach($graduatelistByYear as $graduate) : ?>
        <tr>
            <td><?= Image::profileTag($graduate['imageId'], 'mini') ?></td>
            <td><a href='/profil/<?= $graduate['username'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
            <td><?= $graduate['name'] ?></td>
            <td><?= $graduate['companyName'] ?></td>
            <td><?= $graduate['workDescription'] ?></td>
            <td><?= $graduate['workPlace'] ?></td>
        </tr>
    <? endforeach ?>
    </table>
</p>