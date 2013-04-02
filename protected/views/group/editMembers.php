<div class="groupEditMembers">

<h1>Medlemsredigering for <?= $group->title ?></h1>

<? $this->renderPartial("_menu", array(
	'group' => $group,
)) ?>

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
	<th>Slett</th>
	<th>Rediger</th>
	<th>Brukernavn</th>
	<th>Fullt navn</th>
	<th>Stilling</th>
	<th>Ble medlem</th>
</tr>

<? foreach ($members as $membership):
	$user = $membership->user ?>
	<tr>
		<td><?= $form->checkbox($groupForm, 'delete[' . $user->id . ']') ?></td>
		<td><?= CHtml::link("Rediger", array('editMembership', 'url' => $group->url, 'userId' => $user->id)) ?></td>
		<td><?= $user->username ?></td>
		<td><?= $user->fullName ?></td>
		<td><?=$membership->comission ?></td>
		<td><?= $membership->start?> </td>
	</tr>
<? endforeach; ?>
</table>

<script>
	require(['autocomplete/user'], function(au){
		au.addUserAutocomplete(".groupEditMembers input.username");
	});
</script>

<h1>Legg til nye medlemmer</h1>

<table>
	<tr>
		<th>Brukernavn</th>
		<td>Stilling</th>
	</tr>
<? for ($i = 1; $i <= 4; $i++): ?>
	<tr>
		<td><?= $form->textField($groupForm, "add[$i][username]", array('class' => 'username')) ?></td>
		<td><?= $form->textField($groupForm, "add[$i][comission]") ?></td>
	</tr>

<? endfor; ?>

</table>

<br />
<?= CHtml::submitButton("Send inn") ?>
<?	$this->endWidget() ?>
</div>