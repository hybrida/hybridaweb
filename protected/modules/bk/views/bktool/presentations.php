<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Bedriftspresentasjoner</h2>

<p>
    Dette er en oversikt over alle bedriftspresentasjoner som er registrert på denne nettsiden. Arrangementer må knyttes til bedrifter manuelt siden dette ikke er mulig å gjøre fra nettsidene til <a href="http://www.bedriftspresentasjon.no">The Bedpres Central</a>.
</p>

<br/>
<p>
    <? foreach($years as $year) : ?>
        <h3><?= $year['year'] ?> (<?= $year['sum'] ?>):</h3>
        
        <table id="BK-presentationstable">
            <tr><th>Arrangementstittel</th><th>Tidspunkt</th><th>Tilknyttet bedrift</th></tr>
            <? foreach($companyEvents as $event) : ?>
                <? if($event['year'] == $year['year']){ ?>
                    <tr>
                        <td>
                            <? if($event['bpcID'] > 0){ ?>
                                <?=CHtml::link($event['title'], array('/bedpres/'.$event['bpcID'].'/'.$event['title']))?>
                            <? }else{ ?>
                                <?= $event['title'] ?>
                            <? } ?>
                        </td>
                        <td><?= $event['start'] ?></td>
                        <td><?=CHtml::link($event['companyName'], array('company?id='.$event['companyID']))?></td></tr>
                <? } ?>
            <? endforeach; ?>
        </table>
        <br/>
    <? endforeach; ?>
</p>