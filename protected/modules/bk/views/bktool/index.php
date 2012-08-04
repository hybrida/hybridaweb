<?php $this->renderPartial("_menu", array()); ?>


<h1><?= $this->title ?></h1>

<h2>Om</h2>

<p>
Denne modulen på nettsiden <?= Yii::app()->name ?> er et administrasjonsverktøy for <?= $this->title ?>. Verktøyet er laget for modellere sammenhengen mellom
bedrifter og studenter for å hjelpe <?= $this->title ?> i dets arbeid. Verktøyet er modellert som en egen modul under nettsiden <?= Yii::app()->name ?> 
for enkelhets skyld.
</p>

<br/>
<table id="BK-index-header-table">
    <tr>
        <td id="BK-index-header-left">
            <? foreach($membersSum as $sum) : ?>
                <h3>Aktive medlemmer (<?= $sum['sum'] ?>):</h3>
            <? endforeach; ?>
        </td>
        <td id="BK-index-header-right">
            <h3><?=CHtml::link('Administrer medlemmer', array('editmembers')) ?></h3>
        </td>
    </tr>
</table>

<table id="BK-index-member-table">
        <tr>
            <th></th>
            <th><?=CHtml::link('Navn', array('index?orderby=firstName&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Stilling', array('index?orderby=comission&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Telefonnummer', array('index?orderby=phoneNumber&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Brukernavn', array('index?orderby=username&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Sist innlogget', array('index?orderby=lastLogin&order='.$_SESSION['order'])) ?></th>
        </tr>
        <? foreach ($members as $member): ?>
            <tr>
                <td><?= Image::profileTag($member['imageId'], 'mini') ?></td>
                <td><a href='/profil/<?= $member['username'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></td>
                <td><?= $member['comission'] ?></td>
                <td><?= $member['phoneNumber'] ?></td>
                <td><?= $member['username'] ?></td>
                <td><?= $member['lastLogin'] ?></td>
            </tr>
        <? endforeach; ?>
</table>

<br/>
<h3>Tidligere medlemmer:</h3>

<table id="BK-index-member-table">
        <tr>
            <th></th>
            <th>Navn</th>
            <th>Stilling</th>
            <th>Medlem fra</th>
            <th>Medlem til</th>
        </tr>
        <? foreach ($formerMembers as $member): ?>
            <tr>
                <td><?= Image::profileTag($member['imageId'], 'mini') ?></td>
                <td><a href='/profil/<?= $member['username'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></td>
                <td><?= $member['comission'] ?></td>
                <td><?= $member['start'] ?></td>
                <td><?= $member['end'] ?></td>
            </tr>
        <? endforeach; ?>
</table>
    
<br/>
<p>
    <h4>Virkemåten til verktøyet:</h4>
    <ul>
        <p><li>Kun medlemmer av gruppen til <?= $this->title ?> på nettsiden <?= Yii::app()->name ?> har tilgang til dette verktøyet. Dette gjelder både
                aktive og tidligere medlemmer.</li></p>
        <p><li>Alle med tilgang til denne modulen kan redigere, legge til og fjerne elementer.</li></p>
        <p><li>Alle endringer i modulen blir sporet og kommer som oppdateringer i feeden under <?=CHtml::link('Oppdateringer', array('updates')) ?> 
                for hvert enkelt medlem.</li></p>
        <p><li>Hvis et medlem slettes fra gruppen til <?= $this->title ?>, blir bedriftene som er under kontakt av denne personen automatisk satt til
                statusen "Aktuell senere" av systemet. Alle oppdateringer som er relevant for denne personen under <?=CHtml::link('Oppdateringer', array('updates')) ?> 
                blir slettet for å rydde plass</li></p>
        <p><li>Når en alumnistudent legger til en bedrift som sin arbeidsbedrift, vil dette registreres under <?=CHtml::link('Oppdateringer', array('updates')) ?>. 
                Alumnistudenter som ikke fører opp informasjon om arbeidsbedrift vil ikke registreres under <?=CHtml::link('Oppdateringer', array('updates')) ?>, 
                men all informasjon som publiseres av studenten vil fremdeles være synlig i <?=CHtml::link('Alumnilisten', array('graduates')) ?>.</li></p>
        <p><li>Alumnistudenter har ingen mulighet til å velge bedrifter som ikke finnes i databasen når man registrerer informasjon. 
                Hvis en alumnistudent er blitt ansatt i en bedrift som ikke er i databasen, er det medlemmer av <?= $this->title ?> 
                som har ansvar for å legge til denne bedriften og linke studenten til denne.</li></p>
        <p><li>Bedrifter og bedriftspresentasjoner blir linket sammen basert på bedriftsnavn og ikke bedriftsId. Dette er fordi bedriftspresentasjoner
                kan bli lagt til av andre linjeforeninger via <a href="http://bpc.timini.no/">The Bedpres Central</a> og dermed vil det ikke nødvendigvis være en bedrift som finnes i vår database.
                Alle bedriftspresentasjoner vil uansett publiseres under <?=CHtml::link('Presentasjoner', array('presentations')) ?>, 
                men kun presentasjoner med bedriftsnavn som tilsvarer et bedriftsnavn vi har i databasen vil kunne linkes til en bedrift.</li></p>
        <p><li>Statistikk over lønn til alumnistudenter har ikke blitt implementert i skrivende stund, selv om dette burde gjennomføres.</li></p>
    </ul>
</p>
<p>
    <i>Oppdatert av Frans Erstad, 05.01.2012</i>
</p>