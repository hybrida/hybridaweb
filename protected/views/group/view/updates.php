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

    $loginInfo = array(
        'id' => $this->id
    );
    $sql = "SELECT lastLogin FROM user_new WHERE id = :id";
                    
    $query = $this->pdo->prepare($sql);
    $query->execute($loginInfo);

    $loginInfo = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<? foreach($yearsum as $aYearSum) : ?>
    <p>Sist innlogget: <?= $loginInfo['lastLogin'] ?></p>
<? endforeach ?>

<p>Sist oppdatert:</p>

<p>Fjern valgte elementer, velg alle</p>

<p>
<table id="BK-updatedelements-maintable">
    <tr>
        <th>Merk</th>
        <th>Tidspunkt</th>
        <th>Beskrivelse</th>
        <th>Oppdatert bedrift</th>
        <th>Oppdatert av</th>
    </tr>
</table>
</p>