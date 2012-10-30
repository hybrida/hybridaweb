<?php
$this->breadcrumbs=array(
	'Stillingsutlysninger'=>array('index'),
	'Lag ny' => array('create'),
);

$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>Lag ny stillingsutlysning</h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'companies' => $companies)); ?>