<?php $this->renderPartial("_menu", array()); ?>


<h1><?= $this->title ?></h1>

<h2>Om</h2>

<p>
Denne modulen på HybridaWeb er et administrasjonsverktøy for <?= $this->title ?>. Verktøyet er laget for modellere sammenhengen mellom
bedrifter og studenter for å hjelpe <?= $this->title ?> i dets arbeid. Verktøyet er modellert som en egen modul under HybridaWeb for enkelhets skyld.
</p>
<p>
    <b>Virkemåten til verktøyet:</b>
    <ul>
        <li>Kun medlemmer av gruppen til <?= $this->title ?> på HybridaWeb har tilgang til dette verktøyet. Medlemmer administreres på gruppesiden
            som andre grupper.</li>
        <li>Alle med tilgang til denne modulen kan redigere, legge til og fjerne elementer.</li>
        <li>Alle endringer i modulen blir sporet og kommer som oppdateringer i feeden under <b>Oppdateringer</b> for hvert enkelt medlem.</li>
        <li>Hvis et medlem slettes fra gruppen til <?= $this->title ?>, blir bedriftene som er under kontakt av denne personen automatisk satt til
            statusen "Aktuell senere" av systemet. Alle oppdateringer som er relevant for denne personen under <b>Oppdateringer</b> 
            blir slettet for å rydde plass</li>
        <li>Når en alumnistudent legger til en bedrift som sin arbeidsbedrift, vil dette registreres under <b>Oppdateringer</b>. Alumnistudenter som
            ikke fører opp informasjon om arbeidsbedrift vil ikke registreres under <b>Oppdateringer</b>, men all informasjon som publiseres av studenten
            vil fremdeles være synlig i alumnilisten.</li>
        <li>Alumnistudenter har ingen mulighet til å velge bedrifter som ikke finnes i databasen når man registrerer informasjon. 
            Hvis en alumnistudent er blitt ansatt i en bedrift som ikke er i databasen, er det medlemmer av <?= $this->title ?> som har ansvar for å legge til denne bedriften og linke studenten til denne.</li>
        <li>Bedrifter og bedriftspresentasjoner blir linket sammen basert på bedriftsnavn og ikke bedriftsId. Dette er fordi bedriftspresentasjoner
            kan bli lagt til av andre linjeforeninger via The Bedpres Central og dermed vil det ikke nødvendigvis være en bedrift som finnes i vår database.
            Alle bedriftspresentasjoner vil uansett publiseres under <b>Presentasjoner</b>, men kun presentasjoner med bedriftsnavn som tilsvarer et 
            bedriftsnavn vi har i databasen vil kunne linkes til en bedrift.</li>
    </ul>
</p>
<p>
    <i>Oppdatert av Frans Erstad, 05.01.2012</i>
</p>