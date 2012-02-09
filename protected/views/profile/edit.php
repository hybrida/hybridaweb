<? $this->pageTitle = "Rediger profil" ?>

<h1>Endre profil</h1>
<div class="formSection">
    <div class="fieldDefinition">Fyll inn info fra Facebook:</div>

    <div class="fieldInput"><?= $fb ?></div>

    <div class="fieldExplanation">
        Henter personlig info fra Facebook så du slipper gjøre det selv!
    </div>
</div>

<?
$form = $this->beginWidget('ActiveForm', array(
	'id' => 'profile-edit-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
))
?>
    <div class="formSection">
		<div class="inputGroup">
			<div class="fieldDefinition">
				Fornavn:
			</div>
			<div class="fieldInput">
				<?=$form->textField($model, 'firstName') ?>
			</div>
		</div>
		<div class="inputGroup">
			<div class="fieldDefinition">
				Mellomnavn:
			</div>
			<div class="fieldInput">
				<?=$form->textField($model, 'middleName') ?>
			</div>
		</div>
		<div class="inputGroup">
			<div class="fieldDefinition">
				Etternavn:
			</div>
			<div class="fieldInput">
				<?=$form->textField($model, 'lastName') ?>
			</div>
		</div>
        <div class="inputGoup">
            <div class="fieldDefinition">
                Ferdig utdannet år: 
            </div>
            <div class="fieldInput">
				<?= $form->textField($model, 'graduationYear') ?>
            </div>
        </div>

        <div class="inputGoup">
            <div class="fieldDefinition">
                Studieretning: 
            </div>
            <div class="fieldInput">
				<?= $form->dropDownList($model, 'specializationId', $specializations) ?>
            </div>
        </div>
		
		<div class="inputGroup">
			<div class="fieldDefinition">
				Kjønn:
			</div>
			<div class="fieldInput">
				<?=$form->dropDownList($model, 'gender', array(
					'unknown' => 'Ukjent',
					'male' => 'Male',
					'female' => 'Female',
				)) ?>
			</div>
		</div>

        <div class="inputGoup">
            <div class="fieldDefinition">
                Fødselsdato:
            </div>
			<div class="fieldInput">
				<?= $form->dateField($model, 'birthdate') ?>
			</div>
        </div>

        <div class="fieldExplanation">
            La stå tom om du ikke vil bli plaget med gratulasjoner på bursdagen din.
        </div>
    </div>

    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Privat e-postadresse:</div>
            <div class="fieldInput">
				<?= $form->textField($model, 'altEmail') ?>
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
        <div class="inputGoup">
            <div class="fieldDefinition">Kortnummer:</div>
            <div class="fieldInput">
				<?= $form->textField($model, 'cardinfo') ?>
			</div>

            <div class="fieldExplanation">
            	OBS! Dette er endret fra tidligere!<br />
                For eksempel "4512345" (uten ""). Brukes for å komme inn på Hybridas bedriftspresentasjoner.<br /> 
                <a href="/images/kort_1.png" target="_blank">Hvor finner jeg kortnummeret?</a>
            </div>
        </div>
    </div>

    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Om meg:</div>

            <div class="fieldInput">
				<?= $form->textArea($model, 'description') ?>
			</div>

            <div class="fieldExplanation">
                I infotekst-feltet kan du legge til en beskrivelse av deg selv, hjemmeside og eventuelt
                mobilnummer. Denne informasjonen vil kun hybrider kunne se.
            </div>
        </div>
    </div>
    
    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Jobber i bedrift:</div>
            <div class="fieldInput">
				<?= $form->dropDownList($model, 'workCompanyID', $companies) ?>
			</div>
            <div class="fieldExplanation">
                Navnet på bedriften du har blitt ansatt i. Hvis bedriften ikke finnes i databasen,
                si ifra i stillingsbeskrivelsen, så blir bedriften blir lagt til av Bedkom.
            </div>
        </div>

        <div class="inputGoup">
            <div class="fieldDefinition">Stillingsbeskrivelse:</div>
            <div class="fieldInput">
				<?= $form->textArea($model, 'workDescription') ?>
			</div>
            <div class="fieldExplanation">
                Hva jobber du med? For eksempel offshore konstruksjoner eller NX.
            </div>
        </div>
            
        <div class="inputGoup">
            <div class="fieldDefinition">Arbeidssted</div>
            <div class="fieldInput">
				<?= $form->textField($model, 'workPlace') ?>
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
        <div class="inputGoup">
            <div class="fieldDefinition">Last opp bilde:</div>
            
            <div class="fieldInput">
                <input type="file" name="user_image">
            </div>
            
            <div class="fieldExplanation">
                Du må kanskje oppdatere siden for at det nye bildet skal vises.
            </div>
        </div>
    </div>
<?= CHtml::submitButton('Lagre', array(
	'class' => 'button',
))?>

<? $this->endWidget() ?>