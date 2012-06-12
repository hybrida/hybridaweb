<?php
$this->breadcrumbs=array(
	'Book Sales'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BookSale', 'url'=>array('index')),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>Create BookSale</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>