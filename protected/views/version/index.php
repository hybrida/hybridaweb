<div class="versionIndex">
	<h1>Versjon</h1>
	<p class="hash">
		<strong><?= $hash ?></strong>
	</p>
	<p>
		Du kan gå inn på <a href="<?= $url ?>">github</a> for å se koden.
	</p>
	<p>
		For å se hvor langt bak produksjons-serveren er i forhold til master-branchen:
	</p>

	<code class="g-code">
		git log <?=$hash?>..
	</code>

</div>
