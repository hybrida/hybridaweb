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
                <table id="BK-alumnilist-companytable">
                    <tr>
                        <th>
                            Nr.
                        </th>
                        <th>
                            Bedrift
                        </th>
                        <th>
                            Antall registrert ansatte alumnistudenter
                        </th>
                    </tr>
                    <?
                        // henter ut statistikk for hver bedrift

                        $this->pdo = Yii::app()->db->getPdoInstance();

                        $companies = array();
                        $sql = "SELECT companyName, COUNT(DISTINCT id) AS sum FROM user_new, company 
                                WHERE companyID = workCompanyID GROUP BY companyName
                                ORDER BY sum DESC, companyName ASC";

                        $query = $this->pdo->prepare($sql);
                        $query->execute($companies);

                        $companies = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                
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
            <? foreach($yearsum as $aYearSum) : ?>
                Sum alumnistudenter: <?= $aYearSum['sum'] ?>
            <? endforeach ?>
        </th>
					
	<th id="BK-alumnilist-rightcolumn">
             <?
                // henter ut den totale summen registrert ansatte alumnistudenter

                $this->pdo = Yii::app()->db->getPdoInstance();

                $companysum = array();
                $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new, company WHERE companyID = workCompanyID";
                    
                $query = $this->pdo->prepare($sql);
                $query->execute($companysum);

                $companysum = $query->fetchAll(PDO::FETCH_ASSOC);
                
            ?>
            <? foreach($companysum as $aCompanySum) : ?>
                Sum registrert ansatte alumnistudenter: <?= $aCompanySum['sum'] ?>
            <? endforeach ?>
        </th>
    </tr>
</table>
</p>
				
<p><h3>Alumnistudenter:</h3>

<?
    //sorterer etter fornavn i stigende rekkefølge som standard
    $_SESSION['orderBy'] = 'firstName';
    $_SESSION['order'] = 'ASC';
    
    //denne if-setningen lytter til om variabelen som siden skal sorteres etter endres
    if (isset($_GET['orderBy'])) { 
	$_SESSION['orderBy'] = $_GET['orderBy'];
    }

    //denne if-setningen lytter til om rekkefølgen som siden skal sorteres etter endres
    if (isset($_GET['order'])) {
        
        //denne if-setnigen sjekker hvilken rekkefølge siden skal sorteres i
        if ($_GET['order'] == 'ASC') {
            $_SESSION['order'] = 'DESC';
        }
        else{
            $_SESSION['order'] = 'ASC';
        }
    }
    
    // henter ut informasjon om alumnistudentene

    $this->pdo = Yii::app()->db->getPdoInstance();

    $alumnies = array();
    $sql = "SELECT id, firstName, middleName, lastName, graduationYear, workDescription, workPlace, companyName, companyID FROM user_new 
            LEFT JOIN company ON companyID = workCompanyID
            WHERE graduationYear <= now() ORDER BY ".$_SESSION['orderBy']." ".$_SESSION['order']."";

    $query = $this->pdo->prepare($sql);
    $query->execute($alumnies);

    $alumnies = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<p>
<div id="BK-alumnilist-alumnilistbox">
<table id="BK-alumnilist-maintable">
    <tr>
        <th><a href="<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/Alumni?orderBy=firstName&order=<?= $_SESSION['order'] ?>">Navn</th>
        <th><a href="<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/Alumni?orderBy=graduationYear&order=<?= $_SESSION['order'] ?>">Uteksamineringsår</th>
        <th><a href="<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/Alumni?orderBy=companyName&order=<?= $_SESSION['order'] ?>">Bedrift</th>
        <th>Stillingsbeskrivelse</th>
        <th><a href="<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/Alumni?orderBy=workPlace&order=<?= $_SESSION['order'] ?>">Arbeidssted</th>
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
                <td><a href="<?= Yii::app()->baseUrl ?>/company/<?= $alumni['companyID'] ?>"><?= $alumni['companyName'] ?></a></td>
                <td><?= $alumni['workDescription'] ?></td>
                <td><?= $alumni['workPlace'] ?></td>
                <td>Rediger</td>
            </tr>

            <? $counter++; ?>
            
        <? endforeach ?>
        
    </table>
</div>
</p>