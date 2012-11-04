<div class="g-barTitle">I&amp;IKT-ringen</div>

<? foreach ($companies as $company): ?>
	<div class="g-barText">
		<?= CHtml::link(Image::tag($company->imageId, 'sidebar'), $company->homepage) ?>
	</div>
<? endforeach ?>
