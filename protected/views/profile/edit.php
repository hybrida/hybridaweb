<? $this->pageTitle = "Rediger profil" ?>

<h1>Endre profil</h1>

<div class="formSection">
    <? if(!$hasConnectedToFacebook): ?>
       <div class="fieldDefinition">Facebook:</div>
       <div class="fieldInput">
            <?= Facebook::authLink() ?>
       </div>
    <? else: ?>
       <div class="inputGroup">
            <div class="fieldDefinition">
                Poste til Facebook:
            </div>
            <div class="fieldInput">
                <!-- Checkbox for om man vil poste til Facebook eller ikke -->
            </div>
       </div>
       <div class="inputGroup">
            <div class="fieldDefinition">
                Importer profilbilde:
            </div>
           <div class="fieldInput">
               <!-- Bruk retrieveProfilePicture i Facebook.php og lagre profilbildet -->
           </div>
       </div>
    <? endif ?> 
       <div class="fieldExplanation"></div>
</div>

<?
    $form = $this->beginWidget('ActiveForm', array(
    'id' => 'profile-edit-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<div class="formSection">
    <div class="inputGroup">
        <div class="fieldDefinition">
            Fornavn:
        </div>
        <div class="fieldInput">
            <?= $form->textField($model, 'user[firstName]') ?>
            <?= $form->error($model, 'user[firstName]') ?>
        </div>
    </div>
    <div class="inputGroup">
        <div class="fieldDefinition">
            Mellomnavn:
        </div>
        <div class="fieldInput">
            <?= $form->textField($model, 'user[middleName]') ?>
            <?= $form->error($model, 'user[middleName]') ?>
        </div>
    </div>
    <div class="inputGroup">
        <div class="fieldDefinition">
            Etternavn:
        </div>
        <div class="fieldInput">
            <?= $form->textField($model, 'user[lastName]') ?>
            <?= $form->error($model, 'user[lastName]') ?>
        </div>
    </div>
    <div class="inputGroup">
        <div class="fieldDefinition">
            Ferdig utdannet år: 
        </div>
        <div class="fieldInput">
            <?= $form->textField($model, 'user[graduationYear]') ?>
            <?= $form->error($model, 'user[graduationYear]') ?>
        </div>
    </div>

    <div class="inputGroup">
        <div class="fieldDefinition">
            Studieretning: 
        </div>
        <div class="fieldInput">
            <?= $form->dropDownList($model, 'user[specializationId]', $specializations) ?>
            <?= $form->error($model, 'user[specializationId]') ?>
        </div>
    </div>

    <div class="inputGroup">
        <div class="fieldDefinition">
            Kjønn:
        </div>
        <div class="fieldInput">
            <?=
            $form->dropDownList($model, 'user[gender]', array(
                'unknown' => 'Ukjent',
                'male' => 'Male',
                'female' => 'Female',
            ))
            ?>
<?= $form->error($model, 'user[gender]') ?>
        </div>
    </div>

    <div class="inputGroup">
        <div class="fieldDefinition">
            Fødselsdato:
        </div>
        <div class="fieldInput">
<?= $form->dateField($model, 'user[birthdate]') ?>
<?= $form->error($model, 'user[birthdate]') ?>
        </div>
    </div>

    <div class="fieldExplanation">
        La stå tom om du ikke vil bli plaget med gratulasjoner på bursdagen din.
    </div>
</div>

<div class="formSection">
    <div class="inputGroup">
        <div class="fieldDefinition">Privat e-postadresse:</div>
        <div class="fieldInput">
<?= $form->textField($model, 'user[altEmail]') ?>
<?= $form->error($model, 'user[altEmail]') ?>
        </div>
    </div>

    <div class="fieldExplanation">
        E-posten du skriver inn her er bare synlig for innloggede hybrider.
        Ved å fylle den inn, sikrer du at andre hybrider kan ta kontakt med
        deg etter NTNU. Skriv derfor <strong>ikke</strong> inn NTNU-adressen
        (brukernavn@stud.ntnu.no) - denne mister du når du er ferdig på NTNU!
    </div>
</div>

<div class="formSection">
    <div class="inputGroup">
        <div class="fieldDefinition">Kortnummer:</div>
        <div class="fieldInput">
<?= $form->textField($model, 'user[cardNumber]') ?>
<?= $form->error($model, 'user[cardNumber]') ?>
        </div>

        <div class="fieldExplanation">
<? if (!$model->userModel->cardHash): ?>
                <p style="color: #f00; font-weight: bold">
                    Du har ikke registrert kortnummer!
                </p>
<? endif ?>
            La feltet være blankt for å ikke endre det.<br /><br />
            OBS! Dette er endret fra tidligere!
            <a href="/images/kort_1.png" target="_blank">Hvor finner jeg kortnummeret?</a>
        </div>
    </div>
</div>

<div class="formSection">
    <div class="inputGroup">
        <div class="fieldDefinition">Om meg:</div>

        <div class="fieldInput">
<?= $form->richTextArea($model, 'user[description]') ?>
<?= $form->error($model, 'user[description]') ?>
        </div>

        <div class="fieldExplanation">
            I infotekst-feltet kan du legge til en beskrivelse av deg selv, hjemmeside og eventuelt
            mobilnummer. Denne informasjonen vil kun hybrider kunne se.
        </div>
    </div>
</div>

<div class="formSection">
    <div class="inputGroup">
        <div class="fieldDefinition">Jobber i bedrift:</div>
        <div class="fieldInput">
<?= $form->dropDownList($model, 'user[workCompanyID]', $companies) ?>
<?= $form->error($model, 'user[workCompanyID]', $companies) ?>
        </div>
        <div class="fieldExplanation">
            Navnet på bedriften du har blitt ansatt i. Hvis bedriften ikke finnes i databasen,
            si ifra i stillingsbeskrivelsen, så blir bedriften blir lagt til av Bedkom.
        </div>
    </div>

    <div class="inputGroup">
        <div class="fieldDefinition">Stillingsbeskrivelse:</div>
        <div class="fieldInput">
<?= $form->textArea($model, 'user[workDescription]') ?>
<?= $form->error($model, 'user[workDescription]') ?>
        </div>
        <div class="fieldExplanation">
            Hva jobber du med? For eksempel offshore konstruksjoner eller NX.
        </div>
    </div>

    <div class="inputGroup">
        <div class="fieldDefinition">Arbeidssted</div>
        <div class="fieldInput">
<?= $form->textField($model, 'user[workPlace]') ?>
<?= $form->error($model, 'user[workPlace]') ?>
        </div>
        <div class="fieldExplanation">
            Hvor du jobber (for eksempel Oslo).
        </div>
    </div>

    <div class="fieldExplanation">
        Statistikken fra denne undersølsen publiseres i <a href="#">Aluminilisten</a>.
    </div>

</div>

<div class="formSection">
    <div class="inputGroup">
        <div class="fieldDefinition">Last opp bilde:</div>

        <div class="fieldInput">
<?= $form->fileField($model, 'imageUpload') ?>
        </div>

        <div class="fieldExplanation">

        </div>
    </div>
</div>
<?=
CHtml::submitButton('Lagre', array(
    'class' => 'button',
))
?>

<? $this->endWidget() ?>