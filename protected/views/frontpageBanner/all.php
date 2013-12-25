<h1>Alle forsidebilder</h1>

<?= CHtml::link("Gå tilbake", array("index")) ?>


<?php foreach ($models as $model): ?>
	<h2><?= $model->title ?></h2>

<?php endforeach ?>