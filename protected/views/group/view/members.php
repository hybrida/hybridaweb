<?php $this->renderPartial("menu", $menu); ?>

<h1>
	<?= $title ?>
</h1>

<h2>Medlemmer </h2>

<div class="g-membertable">
	<table>

		<tr>
			<th></th><th>Navn</th><th>Stilling</th><th>Brukernavn</th><th>Telefonnummer</th><th>Sist innlogget</th><th></th>
		</tr>

		<? $counter = 1; ?>

		<? foreach($content as $user) : ?>

			<? if($counter % 2){ ?>
				<tr bgcolor='#CCFFFF'>
			<?	}else{ ?>
				<tr bgcolor='#FFFFFF'>
			<? } ?>

				<td><img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $user['imageId'] ?>/size/3'/></td>
				<td><a href='/profile/<?= $user['id'] ?>'> <?= $user['firstName'] ?> <?= $user['middleName'] ?> <?= $user['lastName'] ?></a></td>
				<td><?= $user['comission'] ?></td>
				<td><?= $user['username'] ?></td>
				<td><?= $user['phoneNumber'] ?></td>
				<td><?= $user['lastLogin'] ?></td>
				<td><?= ($user['admin'] == $user['id'] ? "Admin" : " ") ?></td>
			</tr>

			<? $counter++; ?>

		<? endforeach ?>
	</table>

	<h2>Tidligere medlemmer</h2>

	<? $counter = 1; ?>
	<? print_r($former); ?>
	<? if(!isset($former)) : ?>
		<table>
			<? foreach($former as $user) : ?>

				<? if($counter % 2){ ?>
					<tr bgcolor='#CCFFFF'>
				<?	}else{ ?>
					<tr bgcolor='#FFFFFF'>
				<? } ?>

					<td><img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $user['imageId'] ?>/size/3'/></td>
					<td><a href='/profile/<?= $user['id'] ?>'> <?= $user['firstName'] ?> <?= $user['middleName'] ?> <?= $user['lastName'] ?></a></td>
					<td><?= $user['comission'] ?></td>
				</tr>

				<? $counter++; ?>

			<? endforeach ?>

		</table>
	<? endif ;?>
</div>