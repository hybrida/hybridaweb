<?php $this->renderPartial("_menu", array()); ?>


<h1>
    <?= $this->title ?>
</h1>

<h2>Alumniliste</h2>

<p>
    Alumnilisten er listen over alle studenter som er uteksaminert fra <?= $this->lineOfStudy ?>, og hvor de har blitt ansatt rett etter studiet. 
    Statistikken under er ikke nødvendigvis korrekt, da oversikten gitt her kan være mangelfull.
</p>

<p><h3>Statistikk:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
	<td>
            <div id="BK-alumnilist-yearbox">  
                <table id="BK-alumnilist-yeartable">
                    <tr>
                        <th>Årstall</th><th>Antall alumnistudenter</th><th>Antall registrert ansatte alumnistudenter</th>
                    </tr>
                    
                     <? $counter = 1; ?>
        
                    <? foreach($graduationYears as $year) : ?>

                    <? if($counter % 2){ ?>
                        <tr bgcolor='<?= $this->oddRowColour ?>'>
                    <?	}else{ ?>
                        <tr bgcolor='<?= $this->evenRowColour ?>'>
                    <? } ?>
                                
                            <td><?=CHtml::link($year['graduationYear'], array('graduationyear?id='.$year['graduationYear']))?></td>
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

                        <? $counter++; ?>

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

                    <? if($counter % 2){ ?>
                        <tr bgcolor='<?= $this->oddRowColour ?>'>
                    <?	}else{ ?>
                        <tr bgcolor='<?= $this->evenRowColour ?>'>
                    <? } ?>

                            <td><?= $counter ?></td>
                            <td><?=CHtml::link($company['companyName'], array('company?id='.$company['companyID']))?></td>
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
				
<h3>Alumnistudenter:</h3>

<p>
<div id="BK-alumnilist-alumnilistbox">
<table id="BK-alumnilist-maintable">
    <tr>
        <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/graduates'>Navn</th>
        <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/graduates'>Uteksamineringsår</th>
        <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/graduates'>Bedrift</th>
        <th>Stillingsbeskrivelse</th>
        <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/graduates'>Arbeidssted</th>
        <th>Rediger</th>
    </tr>

        <? $counter = 1; ?>
        
        <? foreach($graduates as $graduate) : ?>
           
            <? if($counter % 2){ ?>
                <tr bgcolor='<?= $this->oddRowColour ?>'>
            <?	}else{ ?>
                <tr bgcolor='<?= $this->evenRowColour ?>'>
            <? } ?>
                    
                <td><a href='/profile/<?= $graduate['id'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
                <td><?=CHtml::link($graduate['graduationYear'], array('graduationyear?id='.$graduate['graduationYear']))?></td>
                <td><?=CHtml::link($graduate['companyName'], array('company?id='.$graduate['companyID']))?></td>
                <td><?= $graduate['workDescription'] ?></td>
                <td><?= $graduate['workPlace'] ?></td>
                <td>Rediger</td>
            </tr>

            <? $counter++; ?>
            
        <? endforeach ?>
        
    </table>
</div>
</p>