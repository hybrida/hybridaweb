<div class="g-barTitle">I&amp;IKT-ringen</div>

<? foreach ($companies as $company): ?>
	<div class="g-barText"><?= Image::tag($company->imageId, 'sidebar') ?></div>
<? endforeach ?>
