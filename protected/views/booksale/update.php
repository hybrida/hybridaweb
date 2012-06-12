<?php
$this->breadcrumbs=array(
	'Book Sales'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BookSale', 'url'=>array('index')),
	array('label'=>'Create BookSale', 'url'=>array('create')),
	array('label'=>'View BookSale', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>Update BookSale <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>