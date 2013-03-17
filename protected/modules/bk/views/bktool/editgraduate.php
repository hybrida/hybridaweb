<?php $this->renderPartial("_menu", array()); ?>

<h1>
	<?= $this->title ?>
</h1>

<h2>Rediger alumnistudent</h2>

<p>
<h2>
	<? foreach ($graduateInfo as $info) : ?>
		<?= Image::profileTag($info['imageId'], 'mini') ?>
		<a href='/profil/<?= $info['username'] ?>'><?= $info['firstName'] ?> <?= $info['middleName'] ?> <?= $info['lastName'] ?></a>
	<? endforeach ?>
</h2>
</p>

<p>

<form name="editgraduateform" method="post"
<? foreach ($graduateInfo as $info) : ?>
		  action="editgraduateform?id=<?= $info['id'] ?>"
	  <? endforeach ?>
	  >
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Alternativ-Email</th>
                <th>
					<? foreach ($graduateInfo as $info) : ?>
						<input name="altemail" type="text" class="textfield" value='<?= $info['altEmail'] ?>' maxlength="255" /> Characters (255)
					<? endforeach ?>
                </th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Spesialisering</th>
                <th>
					<? foreach ($specializationNamesSum as $info) : ?>
						<select name="specialization" size="<?= $info['sum'] ?>">

							<? foreach ($specializationNames as $name) : ?>
								<option value="<?= $name['id'] ?>"

										<? foreach ($graduateInfo as $info) : ?>
											<?= ($name['name'] == $info['name'] ? "selected" : ""); ?>
										<? endforeach ?>

										><?= $name['name'] ?></option>
									<? endforeach ?> 

						<? endforeach ?>
					</select>
                </th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Bedrift</br>(Man kan kun velge bedrifter<br/>som allerede finnes i databasen)</th>
                <th>
					<? foreach ($graduateInfo as $info) : ?>
						<select name="workcompanyid">
							<option value="0">Ingen valgt</option>
							<? foreach ($companiesList as $company) : ?>
								<? if ($info['workCompanyID'] == $company['companyID']) { ?>
									<option value="<?= $company['companyID'] ?>" selected><?= $company['companyName'] ?></option>
								<? } else { ?>
									<option value="<?= $company['companyID'] ?>"><?= $company['companyName'] ?></option>
								<? } ?>
							<? endforeach ?>
						</select>
				<br/><div id="BK-add-errormessage"><i><u><?= $errordata['workcompanyerror'] ?></u></i></div>
			<? endforeach ?>
			</th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Stillingsbeskrivelse</th>
                <th>
					<? foreach ($graduateInfo as $info) : ?>
						<textarea name='workdescription' ><?= $info['workDescription'] ?></textarea>
					<? endforeach ?>
                </th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Arbeidssted</th>
                <th>
					<? foreach ($graduateInfo as $info) : ?>
						<input name="workplace" type="text" class="textfield" value='<?= $info['workPlace'] ?>' maxlength="255" /> Characters (255)
					<? endforeach ?>
                </th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Uteksamineringsår</th>
                <th>
                    <select name="graduationyear" size="10"> 
						<? foreach ($graduationYears as $year) : ?>
							<option value="<?= $year['graduationYear'] ?>" align="center"

									<? foreach ($graduateInfo as $info) : ?>
										<?= ($year['graduationYear'] == $info['graduationYear'] ? "selected" : ""); ?>

									<? endforeach ?>

									><?= $year['graduationYear'] ?></option>
								<? endforeach ?>
                    </select>                    
                </th>
            </tr>
        </table>
    </div>

    <br/>
    <p id="BK-add-button" align="center" >
        <input type="submit" name="Submit" value="Utfør endringer" />
    </p>
</form>