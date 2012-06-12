<?php
$this->pageTitle = "Hybrida pensumsalg";
$this->layout = "//layouts/doubleColumn";
?>

<?php
$this->breadcrumbs=array(
	'Bøker'=>array('index'),
	$model->title => $model->id,
);

$this->menu=array(
	array('label'=>'List BookSale', 'url'=>array('index')),
	array('label'=>'Create BookSale', 'url'=>array('create')),
	array('label'=>'Update BookSale', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BookSale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_view', array('data'=>$model)); ?>