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
    <? foreach($members as $member) : ?>
        <h3><img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $member['imageId'] ?>/size/3'/>
        <a href='/profile/<?= $member['id'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></h3>
        
        <p>
        <div id="BK-companydistribution-container">
        <table>
            <tr>
                <th>Nr.</th><th>Bedriftsnavn</th><th>Status</th><th>Sist tildelt</th><th>Sist oppdatert</th>
            </tr>
            
            <? $counter = 1; ?>
            
            <? foreach($membercompanies as $membercompany) : ?>
                <? if($membercompany['id'] == $member['id']){ ?>
                    <tr bgcolor="#00CC00">
                        <td><?= $counter ?></td>
                        <td><a href="<?= Yii::app()->baseUrl ?>/company/<?= $membercompany['companyID'] ?>"><?= $membercompany['companyName'] ?></a></td>
                        <td><?= $membercompany['status'] ?></td>
                        <td><?= $membercompany['dateAssigned'] ?></td>
                        <td><?= $membercompany['dateUpdated'] ?></td>
                    </tr>
                    
                    <? $counter++; ?>
                <? } ?>
            <? endforeach ?>
        </table>
        </div>
        </p>
    <? endforeach ?>
</p>