<?php
$this->breadcrumbs=array(
	'Book Sales'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BookSale', 'url'=>array('index')),
	array('label'=>'Create BookSale', 'url'=>array('create')),
	array('label'=>'Update BookSale', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BookSale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>View BookSale #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'content',
		'price',
		'author',
		'imageID',
		'timestamp',
	),
)); ?>
