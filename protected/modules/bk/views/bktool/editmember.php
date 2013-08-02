<?php $this->renderPartial("_menu", array()); ?>


<h1><?= $this->title ?></h1>

<h2>Rediger medlem</h2>

<form name='editmemberform' method='post'
<? foreach ($membershipInfo as $member) : ?>
		  action="editmemberform?id=<?= $member['id'] ?>"
	  <? endforeach ?>
	  >
		  <? foreach ($membershipInfo as $member) : ?>
		<h2><?= Image::profileTag($member['imageId'], 'mini') ?>
			<a href='/profil/<?= $member['username'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></h2>
		<br/>
		<p>
			Når sluttdato for medlemskap blir satt, flyttes medlemmet til listen over tidligere medlemmer og status til alle bedrifter som medlemmet kontakter settes til 'Aktuell senere'.
			Alle oppdateringer knyttet til medlemmet blir slettet. Tidligere medlemmer har også tilgang til BK-modulen.
		</p>
		<h3>
			<br/>
			<table id="BK-index-editmember-table">
				<tr>
					<th>
						Stilling
					</th>
					<td>
						<input name="comission" type="text" value='<?= $member['comission'] ?>' class="textfield" maxlength="50" />
					</td>
				</tr>
				<tr>
					<th>
						Medlem fra
					</th>
					<td>
						<input name="start" type="text" value='<?= $member['start'] ?>' class="textfield" maxlength="10" />
					</td>
				</tr>
				<tr>
					<th>
						Medlem til
					</th>
					<td>
						<input name="end" type="text" value="<?= ($member['end'] != '0000-00-00' ? $member['end'] : '' ) ?>" class="textfield" maxlength="10" />
					</td>
				</tr>
			</table>
		</h3>

		<? if (isset($errordata['starttimeerror'])) { ?>
			<br/><div id="BK-add-errormessage"><i><u><?= $errordata['starttimeerror'] ?></u></i></div>

		<? } if (isset($errordata['endtimeerror'])) { ?>
			<br/><div id="BK-add-errormessage"><i><u><?= $errordata['endtimeerror'] ?></u></i></div>
		<? } ?>

	<? endforeach ?>

	<p id="BK-index-editmember-button" align="center">
		<input type="submit" name="Submit" value="Legg til endringer" />
	</p>
</form>