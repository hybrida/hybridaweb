<? $this->pageTitle = "info" ?>


<?
$this->renderPartial('_header', array(
	'user' => $user,
))
?>

<table>
    <tr>
		<td>NTNU-Epost:         </td>
		<td><?= CHtml::mailto($user->username . "@stud.ntnu.no") ?></td>
	</tr>
    <tr>
		<td>Alternativ-Epost:   </td>
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
    <tr>
		<td>Kjønn: </td>
		<td> <?= $user->gender ?></td>
	</tr>
    <tr>
		<td>Fødselsdato: </td>
		<td> <?= ($user->birthdate == 0000 - 00 - 00 ? " " : $user->birthdate) ?></td>
	</tr>

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
