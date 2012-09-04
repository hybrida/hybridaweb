<div class="g-barTitle">Medlemmer i I&IKT-ringen</div>

<? foreach ($companies as $company): ?>
	<div class="g-barText"><?= Image::tag($company->imageId, 'sidebar') ?></div>
<? endforeach ?>
