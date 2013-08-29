<?php
/* @var $this KnightController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Knights',
);

$this->menu=array(
	array('label'=>'Create Knight', 'url'=>array('create')),
	array('label'=>'Manage Knight', 'url'=>array('admin')),
);
?>

<h1>Knights</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
