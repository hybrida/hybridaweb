<style>
	.answer {
		background-color: #DDF;
		padding: 2em;
		margin: 2em;
	}
	
	.output {
		background-color: #FDD;
		padding: 2em;
		margin: 2em;
	}
	
	.hack {
		padding: 0.5em;
		margin: 2em;
		background-color: #DFD;
	}
	.hack div {
		font-weight: bold;
	}
</style>

<h1>Hacking</h1>

<?if (count($hacks) > 0): ?>

	<? foreach ($hacks as $hack): ?>
		<div class="hack">
			<div>Du har blitt hacket!</div>
			<?= $hack->content ?>
		</div>

	<? endforeach ?>

<? endif ?>

<? if ($answer != null): ?>
<div class="answer">
	<h2>Gunnar svarer</h2>
	<?=$answer?>
</div>

<? endif ?>

<? if ($output != ""): ?>
<div class="output">
	<h2>Output fra php-koden</h2>
	<?= $output ?>
</div>

<?endif?>
<p>
	Nå skal det hackes! Dette er en hemmelig side der dere kan få snakke rett til
	serveren vår.
</p>

<p> 
	Serveren vår består av en kar som sitter i bomberommet under stripa.
	Han heter Gunnar og er en reser på å svare og skrive fort.
	Gunnar snakker ikke norsk som oss andre. Som barn av gløshaugen snakker han
	bare php. Likevel er ikke alt som det skal. Han har et par problemer.
</p>

<div style="margin: 1em auto; width: 200px" >
	<img src="http://us.123rf.com/400wm/400/400/dragon_fang/dragon_fang0903/dragon_fang090300174/4507853-a-young-office-worker-wearing-glasses-is-typing-on-his-laptop-computer-isolated-against-a-white-back.jpg"
		 alt=""
		 width="100"/>
</div>
<p>
	Det første problemet er at han ikke er så flink til å lese. Så selv om han 
	arbeider like fort som en hybrid under systemutviklingseksamen, gidder han bare å gjøre jobben om 
	beskrivelsen er veldig kort. Så hvis du skal prate med Gunnar, skriv kort.
</p>

<p>
	Det andre problemet er at han gir etter for masing.
	Hvis man skriker nok så gir han deg 
	tilslutt passordet til databasen vår. Ikke bra.

	Skrikingen mottaes som en funksjon.
	For å skrike til Gunnar, skriv: 
</p>
<blockquote>
	shout("Kan ikke jeg være så snill da!");
</blockquote>

<p>
	For at Gunnar skal gi fra seg passordet er du nødt til å skrike 20 ganger.
	Men siden han ikke er noe flink til å lese må du altså finne en lur måte å
	skrike til han 20 ganger uten å kopiere linjen over 20 ganger etter hverandre.
	Sett igang!
</p>


<?php
$form = $this->beginWidget('ActiveForm', array(
	'id' => 'news_edit-form',
	'htmlOptions' => array(
		'class' => 'g-form'
	),
		));
?>

<div id="row">
	<?= $form->textArea($hacker, 'php') ?>
</div>

<?= CHtml::submitButton('Spør Gunnar') ?>

<? $this->endWidget() ?>