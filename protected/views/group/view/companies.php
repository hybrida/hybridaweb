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

<?
    // henter ut statistikken tilknyttet bedriftsoversikten

    $this->pdo = Yii::app()->db->getPdoInstance();

    $statistics = array();
    $sql = "SELECT status, COUNT(DISTINCT companyName) AS sum FROM company GROUP BY status";

    $query = $this->pdo->prepare($sql);
    $query->execute($statistics);

    $statistics = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<p>
    <table id="BK-companyoverview-supporttable">
        <tr>
            <th>Statistikk:</th>
            <th>Valg:</th>
        </tr>
        <tr>
            <td>
                <div id="BK-companyoverview-container">
                <table id="BK-companyoverview-statisticstable">
                    
                    <? $sum = 0; ?>
                    
                     <? foreach($statistics as $stat) : ?>
           
                        <? switch ($stat['status']){
                                case "Aktuell senere": ?>
                                    <tr bgcolor="yellow">
                        <?          break;
                                case "Blir kontaktet": ?>
                                    <tr bgcolor="#00CC00">
                        <?          break;
                                case "Ikke kontaktet": ?>
                                    <tr bgcolor='#FFFFFF'>
                        <?          break;
                                case "Uaktuell": ?>
                                    <tr bgcolor="#FF0033">
                        <?          break;
                                default: ?>
                                    <tr bgcolor='#FFFFFF'>
                        <? } ?>

                            <td><?= $stat['sum'] ?> <?= $stat['status'] ?></td>
                        </tr>
                        
                        <? $sum = $sum + $stat['sum']; ?>
                    <? endforeach ?>
                        
                    <tr><th><?= $sum ?> Bedrifter totalt</th></tr>
                </table>
                </div>
                
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

<?
    //denne if-setningen lytter til om variabelen som tabellen skal sorteres etter endres
    if (isset($_GET['orderBy'])) { 
	$_SESSION['orderBy'] = $_GET['orderBy'];
    }

    // henter ut informasjon om hver enkelt av bedriftene 

    $this->pdo = Yii::app()->db->getPdoInstance();
    
    //sorterer etter bedriftsnavn som standard
    $companies = array(
        'orderBy' => $_SESSION['orderBy']
    );
    $sql = "SELECT companyID, id, companyName, status, firstName, middleName, lastName, dateAdded FROM company 
    LEFT JOIN user_new ON contactorID = id ORDER BY :orderBy ASC, firstName ASC";

    $query = $this->pdo->prepare($sql);
    $query->execute($companies);

    $companies = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<?= $orderBy ?>

<div id="BK-companyoverview-container">
<p>
<div id="BK-companyoverview-maintablebox">

    <table id="BK-companyoverview-maintable">
        <tr>
            <th><a href="<?= Yii::app()->baseUrl ?>/group/view/<?= $id ?>/Bedrifter?orderBy=companyName">Bedrift</th>
            <th>Status</th>
            <th>Kontaktet av</th>
            <th>Dato lagt til</th>
        </tr>
      
        <? foreach($companies as $company) : ?>
           
            <? switch ($company['status']){
                    case "Aktuell senere": ?>
                        <tr bgcolor="yellow">
            <?          break;
                    case "Blir kontaktet": ?>
                        <tr bgcolor="#00CC00">
            <?          break;
                    case "Ikke kontaktet": ?>
                        <tr bgcolor='#FFFFFF'>
            <?          break;
                    case "Uaktuell": ?>
                        <tr bgcolor="#FF0033">
            <?          break;
                    default: ?>
                        <tr bgcolor='#FFFFFF'>
            <? } ?>
                
                <td><a href="<?= Yii::app()->baseUrl ?>/company/<?= $company['companyID'] ?>"><?= $company['companyName'] ?></a></td>
                <td><?= $company['status'] ?></td> 
                <td><a href='/profile/<?= $company['id'] ?>'><?= $company['firstName'] ?> <?= $company['middleName'] ?> <?= $company['lastName'] ?></a></td>
                <td><?= $company['dateAdded'] ?></td>
            </tr>

        <? endforeach ?>
    </table>

</div>
</p>
</div>