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
	<td id="BK-alumnilist-leftcolumn">
            <div id="BK-alumnilist-yearbox">
                <?
                    // henter ut statistikk for hvert årstrinn

                    $this->pdo = Yii::app()->db->getPdoInstance();

                    $years = array();
                    $sql = "SELECT graduationYear, COUNT(DISTINCT id) AS sum FROM user_new WHERE graduationYear <= now()
                    GROUP BY graduationYear ORDER BY graduationYear DESC";
                    
                    $query = $this->pdo->prepare($sql);
                    $query->execute($years);

                    $years = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                
                <table id="BK-alumnilist-yeartable">
                    <tr>
                        <th>
                            Årstall
                        </th>
                        <th>
                            Antall alumnistudenter
                        </th>
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
					
	<td id="BK-alumnilist-rightcolumn">
            <div id="BK-alumnilist-companybox">
            </div>
	</td>
    </tr>
        
    <tr>
        <th id="BK-alumnilist-leftcolumn">
             <?
                // henter ut den totale summen alumnistudenter for alle årstrinn

                $this->pdo = Yii::app()->db->getPdoInstance();

                $yearsum = array();
                $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new WHERE graduationYear <= now()";
                    
                $query = $this->pdo->prepare($sql);
                $query->execute($yearsum);

                $yearsum = $query->fetchAll(PDO::FETCH_ASSOC);
                
            ?>
            Sum alumnistudenter: <?= $yearsum ?>
        </th>
					
	<th id="BK-alumnilist-rightcolumn">
        </th>
    </tr>
</table>
</p>
				
<p><h3>Alumnistudenter:</h3>

<?
    // henter ut informasjon om alumnistudentene

    $this->pdo = Yii::app()->db->getPdoInstance();

    $alumnies = array();
    $sql = "SELECT id, firstName, middleName, lastName, graduationYear, workDescription FROM user_new 
    WHERE graduationYear <= now()";

    $query = $this->pdo->prepare($sql);
    $query->execute($alumnies);

    $alumnies = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<p>
<div id='BK-alumnilist-alumnilistbox'>
    <table id="BK-alumnilist-maintable">
        <tr>
            <th>Navn</th>
            <th>Uteksamineringsår</th>
            <th>Bedrift</th>
            <th>Stillingsbeskrivelse</th>
            <th>Arbeidssted</th>
            <th>Rediger</th>
        </tr>
        
         <? $counter = 1; ?>
        
        <? foreach($alumnies as $alumni) : ?>
           
            <? if($counter % 2){ ?>
                <tr bgcolor='#CCFFFF'>
            <?	}else{ ?>
                <tr bgcolor='#FFFFFF'>
            <? } ?>
                    
                <td><a href='/profile/<?= $alumni['id'] ?>'> <?= $alumni['firstName'] ?> <?= $alumni['middleName'] ?> <?= $alumni['lastName'] ?></a></td>
                <td><?= $alumni['graduationYear'] ?></td>
                <td></td>
                <td><?= $alumni['workDescription'] ?></td>
                <td></td>
                <td></td>
            </tr>

            <? $counter++; ?>
            
        <? endforeach ?>
        
    </table>
</div>
</p>