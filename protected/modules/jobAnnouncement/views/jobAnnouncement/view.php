<?php
$this->breadcrumbs = array(
	'Stillingsutlysninger'=>array('index'),
	$model->company->companyName . ": " . $model->title => array('view', 'id' => $model->id),
);

$this->renderPartial('_sidebar');
?>
<div class="jobAnnouncementView">
	<h1><?php echo $model->title; ?></h1>

	<strong>Bedrift:</strong> <?= $model->company->name ?><br/>
	<strong>Søknadsfrist:</strong> <?= Html::dateToString($model->deadline) ?> <br/>
	<?= $model->description ?>
</div>