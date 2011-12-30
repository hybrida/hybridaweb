<?php $this->renderPartial("menu", $menu); ?>

<?
    /**
     * Side for oppdaterte elementer
     *
     * @author frans
     */
?>

<h1>
    <?= $title ?>
</h1>

<h2>Oppdaterte elementer</h2>

<?
    // henter ut informasjon om innlogging

    $this->pdo = Yii::app()->db->getPdoInstance();
    
    $userID = Yii::app()->user->id;
    
    $loginInfo = array();
    $sql = "SELECT lastLogin FROM user_new WHERE id = :userID";

    $query = $this->pdo->prepare($sql);
    $query->execute($loginInfo);
    
    $loginInfo = $query->fetchAll(PDO::FETCH_ASSOC);
    
?>

<? foreach($loginInfo as $info) : ?>
    <p>Sist innlogget: <?= $info['lastLogin'] ?></p>
<? endforeach ?>

<p>Sist oppdatert:</p>

<p>Fjern valgte elementer, velg alle</p>

<p>
<div id="BK-updatedelements-maintablebox">
<table id="BK-updatedelements-maintable">
    <tr>
        <th>Merk</th>
        <th>Tidspunkt</th>
        <th>Beskrivelse</th>
        <th>Oppdatert bedrift</th>
        <th>Oppdatert av</th>
    </tr>
</table>
</div>
</p>