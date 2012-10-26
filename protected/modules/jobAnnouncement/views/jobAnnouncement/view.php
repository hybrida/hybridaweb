<?php
$this->breadcrumbs = array(
	'Jobs' => array('index'),
	$model->company->companyName . ": " . $model->title => array('view', 'id' => $model->id),
);

$this->renderPartial('_sidebar');
?>
<div class="jobAnnouncementView">
	<h1><?php echo $model->title; ?></h1>

	<strong>Bedrift:</strong> <?= $model->company->name ?><br/>
	<strong>Startdato:</strong> <?= Html::dateToString($model->start) ?> <br/>
	<strong>Sluttdato:</strong> <?= Html::dateToString($model->end) ?> <br/>
	<?= $model->description ?>
</div>