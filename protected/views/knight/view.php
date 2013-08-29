<?php
/* @var $this KnightController */
/* @var $model Knight */

$this->breadcrumbs=array(
	'Knights'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Knight', 'url'=>array('index')),
	array('label'=>'Create Knight', 'url'=>array('create')),
	array('label'=>'Update Knight', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Knight', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Knight', 'url'=>array('admin')),
);
?>

<h1>View Knight #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'firstName',
		'lastName',
		'graduationYear',
		'grantYear',
		'reason',
	),
)); ?>
