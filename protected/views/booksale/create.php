<?php
$this->pageTitle = "Hybrida pensumsalg";
$this->layout = "//layouts/doubleColumn";
?>

<?php
$this->breadcrumbs=array(
	'Bøker'=>array('index'),
	'Ny' => 'Create',
);

$this->menu=array(
	array('label'=>'List BookSale', 'url'=>array('index')),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>Lag annonse</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>