<?php
$this->breadcrumbs=array(
	'Galleries'=>array('/gallery/gallery/'),
	'Create image',
);

$this->menu=array(
	array('label'=>'List Image', 'url'=>array('/gallery/gallery/')),
	array('label'=>'Manage Image', 'url'=>array('admin')),
);
?>

<h1>Create Image</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>