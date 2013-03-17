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
        <h3><?= Image::profileTag($member['imageId'], 'mini') ?>
        <a href='/profil/<?= $member['username'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></h3>
        
        <p>
        <table id="BK-companydistribution-maintable">
            <tr>
                <th>Nr.</th><th>Prioritet</th><th>Bedriftsnavn</th><th>Status</th><th>Sist tildelt</th><th>Sist oppdatert</th>
            </tr>
            
            <? $counter = 1; ?>
            
            <? foreach($contactedCompanies as $company) : ?>
                <? if($company['id'] == $member['id']){ ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= $company['priority'] ?></td>
                        <td><?=CHtml::link($company['companyName'], array('company?id='.$company['companyID']))?></td>
                        <? switch ($company['status']){
                                case "Aktuell senere": ?>
                                    <td id ="BK-companyoverview-aktuell-senere">
                        <?          break;
                                case "Blir kontaktet": ?>
                                    <td id="BK-companyoverview-blir-kontaktet">
                        <?          break;
                                case "Ikke kontaktet": ?>
                                    <td id="BK-companyoverview-ikke-kontaktet">
                        <?          break;
                                case "Uaktuell": ?>
                                    <td id="BK-companyoverview-uaktuell">
                        <?          break;
                                default: ?>
                                    <td>
                        <? } ?><?= $company['status'] ?></td>
                        <td><?= $company['dateAssigned'] ?></td>
                        <td><?= $company['dateUpdated'] ?></td>
                    </tr>
                    
                    <? $counter++; ?>
                <? } ?>
            <? endforeach ?>
        </table>
        </p>
        <br/>
    <? endforeach ?>
</p>