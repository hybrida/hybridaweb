<?php
/* @var $this KnightController */
/* @var $model Knight */

$this->breadcrumbs=array(
	'Knights'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Knight', 'url'=>array('index')),
	array('label'=>'Create Knight', 'url'=>array('create')),
	array('label'=>'View Knight', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Knight', 'url'=>array('admin')),
);
?>

<h1>Update Knight <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>