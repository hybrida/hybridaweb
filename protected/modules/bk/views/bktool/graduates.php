<?php $this->renderPartial("_menu", array()); ?>


<h1>
    <?= $this->title ?>
</h1>

<h2>Alumniliste</h2>

<p>
    Alumnilisten er listen over alle studenter som er uteksaminert fra Ingeniørvitenskap og IKT, og hvor de har blitt ansatt rett etter studiet. Statistikken under er ikke nødvendigvis korrekt, da oversikten gitt her kan være mangelfull.
</p>

<p><h3>Statistikk:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
	<td>
            <div id="BK-alumnilist-yearbox">  
                <table id="BK-alumnilist-yeartable">
                    <tr>
                        <th>Årstall</th><th>Antall alumnistudenter</th>
                    </tr>
                    
                     <? $counter = 1; ?>
        
                    <? foreach($years as $year) : ?>

                        <? if($counter % 2){ ?>
                            <tr bgcolor='#CCFFFF'>
                        <?	}else{ ?>
                            <tr bgcolor='#FFFFFF'>
                        <? } ?>
                                
                            <td><?= $year['graduationYear'] ?></td>
                            <td><?= $year['sum'] ?></td>
                        </tr>

                        <? $counter++; ?>

                    <? endforeach ?>
                </table>
            </div>
        </td>
    </tr>
        
    <tr>
        <th id="BK-alumnilist-cumulationrow">
            <? foreach($yearsum as $aYearSum) : ?>
                Sum alumnistudenter: <?= $aYearSum['sum'] ?>
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
        
                    <? foreach($companies as $company) : ?>

                        <? if($counter % 2){ ?>
                            <tr bgcolor='#CCFFFF'>
                        <?	}else{ ?>
                            <tr bgcolor='#FFFFFF'>
                        <? } ?>

                            <td><?= $counter ?></td>
                            <td><a href="<?= Yii::app()->baseUrl ?>/company/<?= $company['companyID'] ?>"><?= $company['companyName'] ?></a></td>
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
            <? foreach($companysum as $aCompanySum) : ?>
                Sum registrert ansatte alumnistudenter: <?= $aCompanySum['sum'] ?>
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
                <tr bgcolor='#CCFFFF'>
            <?	}else{ ?>
                <tr bgcolor='#FFFFFF'>
            <? } ?>
                    
                <td><a href='/profile/<?= $graduate['id'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
                <td><?= $graduate['graduationYear'] ?></td>
                <td><a href="<?= Yii::app()->baseUrl ?>/company/<?= $graduate['companyID'] ?>"><?= $graduate['companyName'] ?></a></td>
                <td><?= $graduate['workDescription'] ?></td>
                <td><?= $graduate['workPlace'] ?></td>
                <td>Rediger</td>
            </tr>

            <? $counter++; ?>
            
        <? endforeach ?>
        
    </table>
</div>
</p>