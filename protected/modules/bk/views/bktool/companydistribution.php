<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Fordeling av bedrifter</h2>

<p>
    Fordelingen av bedrifter er oversikten over hvilke bedrifter hvert medlem har ansvaret for å kontakte.
    Kun bedrifter med status "Blir kontaktet" vises på denne oversikten, da det er disse som er aktuelle for kontakt.
</p>

<p>
    <? foreach($contactingMembers as $member) : ?>
        <h3><img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $member['imageId'] ?>/size/3'/>
        <a href='/profile/<?= $member['id'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></h3>
        
        <p>
        <div id="BK-companydistribution-container">
        <table>
            <tr>
                <th>Nr.</th><th>Bedriftsnavn</th><th>Status</th><th>Sist tildelt</th><th>Sist oppdatert</th>
            </tr>
            
            <? $counter = 1; ?>
            
            <? foreach($contactedCompanies as $company) : ?>
                <? if($company['id'] == $member['id']){ ?>
                    <tr bgcolor="#00CC00">
                        <td><?= $counter ?></td>
                        <td><?=CHtml::link($company['companyName'], array('company?id='.$company['companyID']))?></td>
                        <td><?= $company['status'] ?></td>
                        <td><?= $company['dateAssigned'] ?></td>
                        <td><?= $company['dateUpdated'] ?></td>
                    </tr>
                    
                    <? $counter++; ?>
                <? } ?>
            <? endforeach ?>
        </table>
        </div>
        </p>
    <? endforeach ?>
</p>