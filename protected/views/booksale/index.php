<?php
$this->pageTitle = "Hybrida pensumsalg";
$this->layout = "//layouts/doubleColumn";
?>

<?php
$this->breadcrumbs=array(
	'Bøker' => 'Book Sales',
);

$this->menu=array(
	array('label'=>'Create BookSale', 'url'=>array('create')),
	array('label'=>'Manage BookSale', 'url'=>array('admin')),
);
?>

<h1>Pensumbøker</h1>

<p>
<?= CHtml::link("Lag annonse", array("booksale/create"), array(
	'class' => 'button'
)); ?>
</p>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
