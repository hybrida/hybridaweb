<div class="newsManualSignup">
	<? foreach ($attenders as $attender): ?>
	<table>
		<tr>
			<th>Navn</th>
			<th>Epost</th>
		</tr>
		<tr>
			<td><?= $attender->name ?></td>
			<td><?= $attender->email ?></td>
		</tr>
	</table>
	<? endforeach?>

	<?php
	$form = $this->beginWidget('ActiveForm', array(
		'id' => 'newsManualSignup-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
		'htmlOptions' => array(
			'class' => 'g-form',
		),
	));
	?>

	<div class="row">
		<label>Name</label>
		<input type="text" name="name" />
	</div>

	<div class="row">
		<label>Epost</label>
		<input type="text" name="email" />
	</div>

	<div class="row">
		<input type="submit" class="g-button">
	</div>


	<? $this->endWidget() ?>
</div>

<? debug($_POST) ?>