<?php $this->renderPartial("_menu", array()); ?>

<h1>
	<?= $this->title ?>
</h1>

<h2>Tilknytning til <?= $this->industryAssociation ?></h2>

<p>Oversikten viser hver av bedriftenes tilknytning til <?= $this->industryAssociation ?>.</p>

<p>
<table id="BK-companyoverview-supporttable">
	<tr>
		<th id="BK-companyoverview-supporttable-header">Statistikk over relevans:</th>
	</tr>
	<tr>
		<td id="BK-companyoverview-supporttable-element">
			<table id="BK-companyoverview-statisticstable">

				<? $sum = 0; ?>

				<? foreach ($statistics as $stat) : ?>
					<tr>
						<td id="BK-companyoverview-numbercolumn"><?= $stat['sum'] ?></td>

						<?
						switch ($stat['relevance']) {
							case "Høy":
								?>
								<td id ="BK-company-high-relevance">
									<?
									break;
								case "Middels":
									?>
								<td id="BK-company-medium-relevance">
									<?
									break;
								case "Lav":
									?>
								<td id="BK-company-low-relevance">
									<?
									break;
								default:
									?>
								<td>
							<? } ?><?= $stat['relevance'] ?></td>
					</tr>

					<? $sum = $sum + $stat['sum']; ?>
				<? endforeach ?>

				<tr>
					<th id="BK-companyoverview-numbercolumn"><?= $sum ?></th>
					<th id="BK-companyoverview-totaltext">Bedrifter totalt</th>
				</tr>
			</table>
		</td>
	</tr>
</table>
</p>


<br/>
<h2>Bedrifter:</h2>

<p>
<table id="BK-companyoverview-maintable">
	<tr>
		<th><?= CHtml::link('Bedrift', array('industryassociation?orderby=companyName&order=' . $_SESSION['order'])) ?></th>
		<th><?= CHtml::link('Relevans', array('industryassociation?orderby=relevance&order=' . $_SESSION['order'])) ?></th>
		<th><?= CHtml::link('Status', array('industryassociation?orderby=status&order=' . $_SESSION['order'])) ?></th>
		<th><?= CHtml::link('Kontaktet av', array('industryassociation?orderby=firstName&order=' . $_SESSION['order'])) ?></th>
	</tr>

	<? foreach ($companies as $company) : ?>
		<tr> 
			<td><?= CHtml::link($company['companyName'], array('company?id=' . $company['companyID'])) ?></td>
			<?
			switch ($company['relevance']) {
				case "Høy":
					?>
					<td id ="BK-company-high-relevance">
						<?
						break;
					case "Middels":
						?>
					<td id="BK-company-medium-relevance">
						<?
						break;
					case "Lav":
						?>
					<td id="BK-company-low-relevance">
						<?
						break;
					default:
						?>
					<td>
				<? } ?>
				<?= $company['relevance'] ?>
			</td>
			<?
			switch ($company['status']) {
				case "Aktuell senere":
					?>
					<td id="BK-companyoverview-aktuell-senere">
						<?
						break;
					case "Blir kontaktet":
						?>
					<td id="BK-companyoverview-blir-kontaktet">
						<?
						break;
					case "Ikke kontaktet":
						?>
					<td id="BK-companyoverview-ikke-kontaktet">
						<?
						break;
					case "Uaktuell":
						?>
					<td id="BK-companyoverview-uaktuell">
						<?
						break;
					default:
						?>
					<td>
				<? } ?>
				<?= $company['status'] ?>
			</td>
			<td><a href='/profil/<?= $company['username'] ?>'><?= $company['firstName'] ?> <?= $company['middleName'] ?> <?= $company['lastName'] ?></a></td>
		</tr>

	<? endforeach ?>
</table>
</p>