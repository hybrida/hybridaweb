<?
$this->breadcrumbs = array(
	$signup->event->news->title => $signup->event->news->viewUrl,
	"Manull Påmelding" => '',
);
?>
<div class="newsManualSignup">

	<script type="text/javascript">
		function deleteAttender(buttonElement) {
			var trElement = buttonElement.parentNode.parentNode;
			var id = trElement.getAttribute("data-id");
			var name = trElement.getAttribute("data-name");
			if (!confirm("Er du sikker på at du vil slette " + name)) {
				return;
			}
			var ajaxFeedUrl = "<?= $ajaxFeedUrl ?>" + id;
			console.log(ajaxFeedUrl);
			$.ajax({
				type: "get",
				url: ajaxFeedUrl,
				success: function(json) {
					trElement.parentNode.removeChild(trElement);
				}
			});
		}
	</script>

	<h1>Manuell påmelding</h1>
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
		<label>Fornavne</label>
		<?= $form->textField($model, "firstName", array("autofocus" => "autofocus")) ?>
	</div>

	<div class="row">
		<label>Etternavn</label>
		<?= $form->textField($model, "lastName") ?>
	</div>

	<div class="row">
		<label>Epost</label>
		<?= $form->textField($model, "email") ?>
	</div>

	<div class="row">
		<input type="submit" class="g-button">
	</div>


	<? $this->endWidget() ?>

		<table>
		<tr>
			<th>Fornavn</th>
			<th>Etternavn</th>
			<th>Epost</th>
			<th>Rediger</th>
			<th>Slett</th>
		</tr>
	<? foreach ($attenders as $attender): ?>
		<tr data-id="<?= $attender->id ?>" data-name="<?= $attender->firstName . " " . $attender->lastName ?>">
			<td><?= $attender->firstName ?></td>
			<td><?= $attender->lastName ?></td>
			<td><?= $attender->email ?></td>
			<td><?= CHtml::link("Rediger", array("editManualSignup", "id" => $attender->id)) ?></td>
			<td><input type="button" value="X"
					class="g-deleteButton" onClick="js:deleteAttender(this)" /></td>
		</tr>
	<? endforeach?>
	</table>
</div>