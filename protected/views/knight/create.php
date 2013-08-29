<?php
/* @var $this KnightController */
/* @var $model Knight */

$this->breadcrumbs=array(
	'Knights'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Knight', 'url'=>array('index')),
	array('label'=>'Manage Knight', 'url'=>array('admin')),
);
?>

<h1>Create Knight</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>