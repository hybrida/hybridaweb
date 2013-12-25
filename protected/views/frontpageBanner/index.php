<div class="frontpagebannerIndex">
	<h1>Frontpage Banner</h1>

	<?= CHtml::link("Se alle", array("all")) ?>


	<?php $this->renderPartial('_form', array('model' => $model)) ?>
</div>