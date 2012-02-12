<?php
$this->breadcrumbs=array(
	'Images',
);

$this->menu=array(
	array('label'=>'Create Image', 'url'=>array('create')),
	array('label'=>'Manage Image', 'url'=>array('admin')),
);
?>

<h1>Images</h1>

<?php 
foreach ($models as $m)
{
	echo CHtml::link($m['title'], array('view', 'id' => $m['id']));
	echo "<br>";
}
?>

