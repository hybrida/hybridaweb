<? $this->pageTitle = "Statistikk" ?>

<div class="adminView">
	<h1>Statistikk</h1>

	<h3>Nyheter</h3>
	<p>
		<b>Antall:</b>
		<?= $stats['news']['count'] ?>
	</p>
	<p>
		<b>Siste måned:</b>
		<?= $stats['news']['lastMonth'] ?>
	</p>

	<h3>Brukere</h3>
	<p>
		<b>Antall:</b>
		<?= $stats['users']['count'] ?>
	</p>
</div>
