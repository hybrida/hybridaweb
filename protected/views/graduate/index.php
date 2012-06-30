<?php

$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); ?>
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
<?
$this->endClip();
?>

<h2>Alumniliste</h2>

<p>
    Alumnilisten er listen over alle studenter som er uteksaminert fra <?= $this->lineOfStudy ?>, og hvor de har blitt ansatt rett etter studiet. 
    Statistikken under er ikke nødvendigvis korrekt, da oversikten gitt her kan være mangelfull.
</p>

<h2>Statistikk:</h2>

<h3>Alumnistudenter sortert på år:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
	<td>
            <div id="BK-alumnilist-yearbox">  
                <table id="BK-alumnilist-yeartable">
                    <tr>
                        <th>Årstall</th><th>Antall alumnistudenter</th><th>Antall registrert ansatte alumnistudenter</th>
                    </tr>
                    <? foreach($graduationYears as $year) : ?>

                        <tr> 
                            <td><?=CHtml::link($year['graduationYear'], array('graduationyear', 'id' => $year['graduationYear']))?></td>
                            <td>
                                <? foreach($graduatesByYear as $graduate) : ?>
                                    <? if($graduate['graduationYear'] == $year['graduationYear']){ ?>
                                        <?= $graduate['sum'] ?>
                                    <? } ?>
                                <? endforeach ?>
                            </td>
                            <td>
                                <? foreach($employeesByYear as $employee) : ?>
                                    <? if($employee['graduationYear'] == $year['graduationYear']){ ?>
                                        <?= $employee['sum'] ?>
                                    <? } ?>
                                <? endforeach ?>
                            </td>
                        </tr>
                    <? endforeach ?>
                </table>
            </div>
        </td>
    </tr>
        
    <tr>
        <th id="BK-alumnilist-cumulationrow">
            <? foreach($graduatesSum as $graduateSum) : ?>
                Sum alumnistudenter: <?= $graduateSum['sum'] ?>
            <? endforeach ?>
        </th>
    </tr>
</table>
</p>

<br/>
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
        
                    <? foreach($employingCompanies as $company) : ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $company['companyName']?></td>
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
            <? foreach($employeesSum as $employeeSum) : ?>
                Sum registrert ansatte alumnistudenter: <?= $employeeSum['sum'] ?>
            <? endforeach ?>
        </th>
    </tr>
</table>
</p>