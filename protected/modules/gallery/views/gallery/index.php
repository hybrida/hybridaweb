<?php
$this->breadcrumbs=array(
	'Galleries',
);

$this->menu=array(
	array('label'=>'Create Gallery', 'url'=>array('create')),
	array('label'=>'Manage Gallery', 'url'=>array('admin')),
	array('label'=>'Upload Image', 'url'=>array('/gallery/image/create')),
);
?>

<h1>Galleries</h1>

<?php 

foreach($models as $m)
{
	echo CHtml::link($m['title'], array('view', 'id' => $m['id']));
	echo "<br>";
        echo $this->renderPartial("_view", array("model" => $m));
}
?>
