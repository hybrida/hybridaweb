<div class="g-barTitle">I&amp;IKT-ringen</div>

<? foreach ($companies as $company): ?>
	<div class="g-barText">
		<?= Html::externalLink(Image::tag($company->imageID, 'sidebar'), $company->homepage) ?>
	</div>
<? endforeach ?>
