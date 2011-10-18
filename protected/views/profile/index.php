		<h1> <?= $info['firstName'] ." ". $info['middleName'] ." ". $info['lastName'] ?> </h1>
        
		<div class='menuPage'>
		<a href='<?= $id ?>/sub/0'>Kommentarer</a>
        <a href='<?= $id ?>/sub/1'>Info</a>
		<a href='<?= $id ?>/sub/2'>Annet</a>
		</div>

        
<table>
<tr><td>Epost: 			</td><td> <a href='mailto:<?= $info['username'] ?>"@stud.ntnu.no' ><?= $info['username'] ?>@stud.ntnu.no</a></td></tr>
<tr><td>Hjemmeside:     </td><td> <a href='http://folk.ntnu.no/<?= $info['username'] ?>'>http://folk.ntnu.no/<?= $info['username'] ?></a>
<tr><td>Telefon: 		</td><td> <?= $info['phoneNumber'] ?></td></tr>
<tr><td>Spesialisering: </td><td> <?= ( !$info['specialization'] ? " Ingen enda " : "et eller annet" ) ?></td></tr>
<tr><td>Avgangsår: 		</td><td> <?= $info['graduationYear'] ?></td></tr>
<tr><td>Medlem:         </td><td> <?= ($info['member'] ? "ja" : "nei") ?></td></tr>
</table>
        