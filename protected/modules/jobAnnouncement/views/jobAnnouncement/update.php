<?php
$this->breadcrumbs=array(
	'Stillingsutlysninger'=>array('index'),
	$model->company->companyName . ": " . $model->title => array('view', 'id' => $model->id),
	'Oppdater' => null,
);

$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'View Job', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>Oppdater stillingsutlysning <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'companies' => $companies)); ?>