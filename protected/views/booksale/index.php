<?php
$this->breadcrumbs=array(
	'Book Sales',
);

$this->menu=array(
	array('label'=>'Create BookSale', 'url'=>array('create')),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>Book Sales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
