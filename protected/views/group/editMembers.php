<h1>Medlemsredigering for <?= $group->title ?></h1>

	<?php
	$form = $this->beginWidget('ActiveForm', array(
		'id' => 'news_edit-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	));
	?>
<h1>Slett medlemmer</h1>
<table border="1">
	<tr>
	<th>Slett medlem</th>
	<th>Brukernavn</th>
	<th>Fullt navn</th>
	<th>Ble medlem</th>
</tr>

<? foreach ($members as $membership):
	$user = $membership->user ?>
	<tr>
		<td><?= $form->checkbox($groupForm, 'delete[' . $user->id . ']') ?></td>
		<td><?= $user->username ?></td>
		<td><?= $user->fullName ?></td>
		<td><?= $membership->start?> </td>
	</tr>
<? endforeach; ?>
</table>

<h1>Legg til nye medlemmer</h1>
<p>
	Skriv inn brukernavn separert med komma
</p>
<?=$form->textArea($groupForm, 'add') ?>
<br />
<?= CHtml::submitButton("Send inn") ?>
<?	$this->endWidget() ?>