		<h1> <?= $firstName ." ". $middleName ." ". $lastName ?> </h1>
        
		<div class='menuPage'>
		<a href='<?= $id ?>/sub/0'>Kommentarer</a>
        <a href='<?= $id ?>/sub/1'>Info</a>
		<a href='<?= $id ?>/sub/2'>Annet</a>
		</div>

        
<table>
<tr><td>Epost: 			</td><td> <a href='mailto:<?= $username ?>"@stud.ntnu.no' ><?= $username ?>@stud.ntnu.no</a></td></tr>
<tr><td>Hjemmeside:     </td><td> <a href='http://folk.ntnu.no/<?= $username ?>'>http://folk.ntnu.no/<?= $username ?></a>
<tr><td>Telefon: 		</td><td> <?= $phoneNumber ?></td></tr>
<tr><td>Spesialisering: </td><td> <?= ( !$specialization ? " Ingen enda " : "et eller annet" ) ?></td></tr>
<tr><td>Avgangsår: 		</td><td> <?= $graduationYear ?></td></tr>
<tr><td>Medlem:         </td><td> <?= ($member ? "ja" : "nei") ?></td></tr>
</table>
        