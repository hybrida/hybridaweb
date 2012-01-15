<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>
    Oppdaterte elementer 
    <? foreach($relevantUpdatesInfo as $info) : ?>
        (<?= $info['sum'] ?>)
    <? endforeach ?>
</h2>

<p>
    Sist innlogget: 
    <? foreach($loginInfo as $info) : ?>
        <?= $info['lastLogin'] ?>
    <? endforeach ?>
</p>

<p>
    Sist oppdatert: 
    <? foreach($lastUpdateInfo as $info) : ?>
        <?= $info['latesttimestamp'] ?>
    <? endforeach ?>
</p>

<form name='deleteupdateform' method='post' action='deleteupdateform'>
<p> 
    <table id='BK-updatedelements-selectiontable'>
        <tr>
            <td><input type='submit' name='emptylog' value='Fjern valgte elementer' /></td>
            <td><h4><input type='checkbox' name='selectedupdates[]' value='deleteall' /> Velg alle</h4></td>
        </tr>
    </table>
</p>

<p>
<div id="BK-updatedelements-maintablebox">
<table id="BK-updatedelements-maintable">
    <tr>
        <th>Merk</th>
        <th><?=CHtml::link('Tidspunkt', array('updates?orderby=dateAdded')) ?></th>
        <th><?=CHtml::link('Beskrivelse', array('updates?orderby=description')) ?></th>
        <th><?=CHtml::link('Oppdatert bedrift', array('updates?orderby=companyName')) ?></th>
        <th><?=CHtml::link('Oppdatert av', array('updates?orderby=firstName')) ?></th>
    </tr>
    <? $counter = 1; ?>
        
    <? foreach($relevantUpdates as $update) : ?>

        <? if($counter % 2){ ?>
            <tr bgcolor='<?= $this->oddRowColour ?>'>
        <?	}else{ ?>
            <tr bgcolor='<?= $this->evenRowColour ?>'>
        <? } ?>
                <td><input type='checkbox' name='selectedupdates[]' value='<?= $update['updateId'] ?>' /></td>
                <td><?= $update['dateAdded'] ?></td>
                <td><?= $update['description'] ?></td>
                <td><?=CHtml::link($update['companyName'], array('company?id='.$update['companyId']))?></td>
                <td><a href='/profile/<?= $update['id'] ?>'> <?= $update['firstName'] ?> <?= $update['middleName'] ?> <?= $update['lastName'] ?></a></td>
            </tr>

        <? $counter++; ?>
    <? endforeach ?>
</table>
</div>
</p>
</form>