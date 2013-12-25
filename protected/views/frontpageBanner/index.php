<div class="frontpagebannerIndex">
	<h1>Frontpage Banner</h1>

	<?= CHtml::link("Se alle", array("all")) ?>


	<p>
		Her kan man laste opp nye forsidebannere.
		Pass på at bildet har et nogen lunde passende format før du laster det
			opp.
		Etter at det er lastet opp, blir det klippet/dratt ut til 1000px i
			bredden.
	</p>

	<p>
		Bildet kan være så høyt som man vil, men en høyde på 300px er ofte
			passende.
	</p>

	<p>
		Tittelfeltet må fylles ut, men har for øyeblikket ingen betydning.
	</p>

	<?php $this->renderPartial('_form', array('model' => $model)) ?>
</div>