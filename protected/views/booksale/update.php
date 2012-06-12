<?php
$this->pageTitle = "Oppdater annonse";
$this->layout = "//layouts/doubleColumn";
?>

<?php
$this->breadcrumbs=array(
	'Bøker'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Oppdater' => 'Update',
);

$this->menu=array(
	array('label'=>'List BookSale', 'url'=>array('index')),
	array('label'=>'Create BookSale', 'url'=>array('create')),
	array('label'=>'View BookSale', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>Oppdater <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>