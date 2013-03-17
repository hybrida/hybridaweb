<?php $this->renderPartial("_menu", array()); ?>

<h1>
	<?= $this->title ?>
</h1>

<h2>Alumniliste for uteksamineringsår <?= $graduationyear ?></h2>

<p>
    Alumnilisten er listen over alle studenter som er uteksaminert fra <?= $this->lineOfStudy ?>, og hvor de har blitt ansatt rett etter studiet. 
    Statistikken under er ikke nødvendigvis korrekt, da oversikten gitt her kan være mangelfull.
</p>


<h2>Statistikk for studenter fra hele <?= $this->lineOfStudy ?>:</h2>

<h3>Alumnistudenter sortert på år:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
		<td>
            <div id="BK-alumnilist-yearbox">  
                <table id="BK-alumnilist-yeartable">
                    <tr>
                        <th>Årstall</th><th>Antall alumnistudenter</th><th>Antall registrert ansatte alumnistudenter</th>
                    </tr>

					<? foreach ($graduationYears as $year) : ?>
						<tr>
							<td><?= CHtml::link($year['graduationYear'], array('graduationyear?id=' . $year['graduationYear'])) ?></td>
							<td>
								<? foreach ($graduatesByYear as $graduate) : ?>
									<? if ($graduate['graduationYear'] == $year['graduationYear']) { ?>
										<?= $graduate['sum'] ?>
									<? } ?>
								<? endforeach ?>
							</td>
							<td>
								<? foreach ($employeesByYear as $employee) : ?>
									<? if ($employee['graduationYear'] == $year['graduationYear']) { ?>
										<?= $employee['sum'] ?>
									<? } ?>
								<? endforeach ?>
							</td>
						</tr>
					<? endforeach ?>
                </table>
            </div>
        </td>
    </tr>

    <tr>
        <th id="BK-alumnilist-cumulationrow">
			<? foreach ($graduatesSum as $graduateSum) : ?>
				Sum alumnistudenter: <?= $graduateSum['sum'] ?>
			<? endforeach ?>
        </th>
    </tr>
</table>
</p>

<br/>
<h3>Alumnistudenter i bedrifter:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
		<td>
            <div id="BK-alumnilist-companybox">
                <table id="BK-alumnilist-companytable">
                    <tr>
                        <th>Nr.</th><th>Bedrift</th><th>Antall registrert ansatte alumnistudenter</th>
                    </tr>

					<? $counter = 1; ?>

					<? foreach ($employingCompanies as $company) : ?>
						<tr>
							<td><?= $counter ?></td>
							<td><?= CHtml::link($company['companyName'], array('company?id=' . $company['companyID'])) ?></td>
							<td><?= $company['sum'] ?></td>
						</tr>

						<? $counter++; ?>
					<? endforeach ?>
                </table>
            </div>
		</td>
    </tr>
    <tr>
		<th id="BK-alumnilist-cumulationrow">
			<? foreach ($employeesSum as $employeeSum) : ?>
				Sum registrert ansatte alumnistudenter: <?= $employeeSum['sum'] ?>
			<? endforeach ?>
        </th>
    </tr>
</table>
</p>

<br/>
<? foreach ($graduatesSumByYear as $graduateSum) : ?>
	<h2>Studenter med uteksamineringsår <?= $graduationyear ?> (<?= $graduateSum['sum'] ?>):</h2>
<? endforeach ?>

<h3>Alumnistudenter i bedrifter:</h3>

<p>
<table id="BK-alumnilist-supporttable">
    <tr>
		<td>
            <div id="BK-alumnilist-companybox">
                <table id="BK-alumnilist-companytable">
                    <tr>
                        <th>Nr.</th><th>Bedrift</th><th>Antall registrert ansatte alumnistudenter</th>
                    </tr>
					<? $counter = 1; ?>
					<? foreach ($employingCompaniesByYear as $company) : ?>
						<tr>
							<td><?= $counter ?></td>
							<td><?= CHtml::link($company['companyName'], array('company?id=' . $company['companyID'])) ?></td>
							<td><?= $company['sum'] ?></td>
						</tr>
						<? $counter++; ?>
					<? endforeach ?>
                </table>
            </div>
		</td>
    </tr>
    <tr>
		<th id="BK-alumnilist-cumulationrow">
			<? foreach ($employeesSumByYear as $employeeSum) : ?>
				Sum registrert ansatte alumnistudenter: <?= $employeeSum['sum'] ?>
			<? endforeach ?>
        </th>
    </tr>
</table>
</p>

<br/>
<? foreach ($graduatesSumByYear as $graduateSum) : ?>
	<h3>Alle studenter med uteksamineringsår <?= $graduationyear ?> (<?= $graduateSum['sum'] ?>):</h3>
<? endforeach ?>

<p>
<table id="BK-alumnilist-maintable">
	<? foreach ($graduatesSumByYear as $graduateSum) : ?>
		<tr>
			<th></th>
			<th><?= CHtml::link('Navn', array('graduationyear?id=' . $graduationyear . '&orderby=firstName&order=' . $_SESSION['order'])) ?></th>
			<th><?= CHtml::link('Spesialisering', array('graduationyear?id=' . $graduationyear . '&orderby=specialization&order=' . $_SESSION['order'])) ?></th>
			<th><?= CHtml::link('Bedrift', array('graduationyear?id=' . $graduationyear . '&orderby=companyName&order=' . $_SESSION['order'])) ?></th>
			<th>Stillingsbeskrivelse</th>
			<th><?= CHtml::link('Arbeidssted', array('graduationyear?id=' . $graduationyear . '&orderby=workPlace&order=' . $_SESSION['order'])) ?></th>
		</tr>

	<? endforeach ?>


	<? foreach ($graduatelistByYear as $graduate) : ?>
		<tr>
			<td><?= Image::profileTag($graduate['imageId'], 'mini') ?></td>
			<td><a href='/profil/<?= $graduate['username'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
			<td><?= $graduate['name'] ?></td>
			<td><?= CHtml::link($graduate['companyName'], array('company?id=' . $graduate['companyID'])) ?></td>
			<td><?= $graduate['workDescription'] ?></td>
			<td><?= $graduate['workPlace'] ?></td>
		</tr>
	<? endforeach ?>
</table>
</p>