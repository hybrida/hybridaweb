<? $this->pageTitle = "info" ?>


<?
$this->renderPartial('_header', array(
	'user' => $user,
))
?>

<table>
    <tr>
		<td>NTNU e-post:         </td>
		<td><?= CHtml::mailto($user->username . "@stud.ntnu.no") ?></td>
	</tr>
    <tr>
		<td>Alternativ e-post:   </td>
		<td> <?= CHtml::mailto($user->altEmail) ?></td>
	</tr>
    <tr>
		<td>Hjemmeside: </td>
		<td><? 
			$address = "http://folk.ntnu.no/" . $user->username;
			echo CHtml::link($address, $address) 
		?></td>
    <tr>
		<td>Telefon: </td>
		<td> <?= $user->phoneNumber ?></td>
	</tr>
	
	<? if ($user->gender != "unknown") { ?>
    <tr>
		<td>Kjønn: </td>
		<td> <?= $user->getGenderInNorwegian() ?></td>
	</tr>
	<? } ?>
	
	<? if ($user->birthdate != '0000-00-00'): ?>
		<tr>
			<td>Fødselsdato: </td>
			<td> <?= Html::dateToString($user->birthdate) ?></td>
		</tr>
	<? endif ?>
		
    <tr>
		<td>Spesialisering:     </td>
		<td><?= $user->specialization ? $user->specialization->name : ""?></td>
	</tr>
    <tr>
		<td>Avgangsår:          </td>
		<td><?=CHtml::link($user->graduationYear, array('/students/view', 'id' => $user->graduationYear))?></td>
	</tr>
    <tr>
		<td>Medlemskap:         </td>
		<td> <?= ($user->member == "true" ? "Medlem" : "Ikke Medlem") ?></td>
	</tr>

    <tr>
		<td>Beskrivelse:        </td>
		<td> <?= $user->description ?></td>
	</tr>
</table>

<? if($user->linkedin): ?>
    <h2>LinkedIn:</h2>
    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
    <script type="IN/MemberProfile" data-id="http://www.linkedin.com/<?= $user->linkedin ?>" data-format="inline"></script>
<? endif ?>
