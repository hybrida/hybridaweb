<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Gallery', 'url'=>array('gallery/index')),
	array('label'=>'Create Gallery', 'url'=>array('gallery/create')),
	array('label'=>'Update Gallery', 'url'=>array('gallery/update', 'id'=>$model->id)),
	array('label'=>'Delete Gallery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gallery', 'url'=>array('gallery/admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php 
$this->renderPartial("_view", array('model' => $model));
 ?>
