<? $this->pageTitle = $user->fullName ?>


<?
$this->renderPartial('_header', array(
	'user' => $user,
))
?>
<div class="profileInfo">
	<table class="infoTable">
		<tr>
			<th>NTNU e-post:</th>
			<td><?= CHtml::mailto($user->username . "@stud.ntnu.no") ?></td>
		</tr>
		<tr>
			<th>Alternativ e-post:</th>
			<td> <?= CHtml::mailto($user->altEmail) ?></td>
		</tr>
		<tr>
			<th>Hjemmeside:</th>
			<td><?
				$address = "http://folk.ntnu.no/" . $user->username;
				echo CHtml::link($address, $address)
			?></td>
		<tr>
			<th>Telefon:</th>
			<td> <?= $user->phoneNumber ?></td>
		</tr>

		<? if ($user->gender != "unknown") { ?>
		<tr>
			<th>Kjønn:</th>
			<td> <?= $user->getGenderInNorwegian() ?></td>
		</tr>
		<? } ?>

		<? if ($user->birthdate != '0000-00-00'): ?>
			<tr>
				<th>Fødselsdato:</th>
				<td> <?= Html::dateToString($user->birthdate) ?></td>
			</tr>
		<? endif ?>

		<tr>
			<th>Spesialisering:</th>
			<td><?= $user->specialization ? $user->specialization->name : ""?></td>
		</tr>
		<tr>
			<th>Avgangsår:</th>
			<td><?=CHtml::link($user->graduationYear, array('/students/view', 'id' => $user->graduationYear))?></td>
		</tr>
		<tr>
			<th>Medlemskapet: </th>
			<td> <?= ($user->member == "true" ? "Medlem" : "Ikke Medlem") ?></td>
		</tr>

	</table>
	<article class="userDescription">
		<?= $user->description ?>
	</article>

	<? if($user->linkedin): ?>
		<h2>LinkedIn:</h2>
		<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		<script type="IN/MemberProfile" data-id="http://www.linkedin.com/<?= $user->linkedin ?>" data-format="inline"></script>
	<? endif ?>
</div>