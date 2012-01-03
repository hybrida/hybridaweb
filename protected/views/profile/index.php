<div id='edit'>
    <a href='<?= Yii::app()->baseURL ?>/profile/edit'>Endre</a>
</div>

<h1> <?= $firstName ." ". $middleName ." ". $lastName ?> </h1>
        
		<div id='groupNavigation'>
		<a class='groupNavigationItem' href='<?= $id ?>/sub/0'>Kommentarer</a>
        <a class='groupNavigationItem' href='<?= $id ?>/sub/1'>Info</a>
		<a class='groupNavigationItem' href='<?= $id ?>/sub/2'>Annet</a>
		</div>

        
<table>
    <tr><td>NTNU-Epost:         </td><td> <a href='mailto:<?= $username ?>@stud.ntnu.no' ><?= $username ?>@stud.ntnu.no</a></td></tr>
    <tr><td>Alternativ-Epost:   </td><td> <a href='mailto:<?= $altEmail ?>' ><?= $altEmail ?></a></td></tr>
    <tr><td>Hjemmeside:         </td><td> <a href='http://folk.ntnu.no/<?= $username ?>'>http://folk.ntnu.no/<?= $username ?></a>
    <tr><td>Telefon:            </td><td> <?= $phoneNumber ?></td></tr>
    <tr><td>                    </td><td> </td></tr>
    <tr><td>Kjønn:              </td><td> <?= $gender ?></td></tr>
    <tr><td>Fødselsdato:        </td><td> <?= ($birthdate == 0000-00-00 ? " " : $birthdate) ?></td></tr>
    <tr><td>                    </td><td> </td></tr>
    <tr><td>Spesialisering:     </td><td> <a href='<?= Yii::app()->baseURL ?>/#'><?= ( !$name ? " " : $name ) ?></td></tr>
    <tr><td>Avgangsår:          </td><td> <a href='<?= Yii::app()->baseURL ?>/profile/all/<?= $graduationYear ?>'><?= $graduationYear ?></td></tr>
    <tr><td>Medlemskap:         </td><td> <?= ($member ? "Medlem" : "Ikke Medlem") ?></td></tr>
    <tr><td>NTNU-Kortnummer:    </td><td> <?= $cardinfo ?></td></tr>
    <tr><td>Beskrivelse:        </td><td> <?= $description ?></td></tr>
</table>
        