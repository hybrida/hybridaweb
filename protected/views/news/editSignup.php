<?
$this->breadcrumbs = array(
	$news->title => $news->viewUrl,
);
?>

<div class="newsEditSignup">
<h1>Endre påmelding for: <?= $news->title ?></h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'news_create_signup',
	'htmlOptions' => array(
		'class'=> 'g-form',
	),
));
?>

<table class="attenders">

	<tr>
		<th>Slett</th>
		<th>Navn</th>
	</tr>
	<? foreach ($attenders as $attender): ?>
		<tr class="attender">
			<td class="delete"><?= $form->checkbox($formModel, 'delete[' . $attender->id . ']') ?></td>
			<td class="name"><?= $attender->fullName ?></td>
		</tr>
	<? endforeach ?>


</table>

	<script>
		require(['autocomplete/user'], function(au){
			au.addUserAutocomplete(".newsEditSignup .row input");
		});
	</script>

	<h2>Legg til ny bruker</h2>
	<div class="row">
		<label>Brukernavn</label>
		<?= $form->textField($formModel, 'username', array('autofocus' => 'autofocus')) ?>
	</div>

	<div class="row">
		<input type="submit" class="g-button" value="Lagre">
	</div>

	<? $this->endWidget() ?>
</div>

