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
    
    $sql = "SELECt lastLogin FROM user_new WHERE id = ?";
    $command = Yii::app()->db->createCommand($sql);
    $query = $command->query(array(Yii::app()->user->id));
    $loginInfo = $query->read();
    
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
</divZ
</p>