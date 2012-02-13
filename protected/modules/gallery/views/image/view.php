<?php
if (!is_null($gallery))
{
    $this->breadcrumbs=array(
	'Galleries'=>array('gallery/index'),
	$gallery->title => array('gallery/view', 'id' => $model['galleryId']),
	$model->title,
    );
}
else
{
    $this->breadcrumbs=array(
	'Galleries'=>array('gallery/index'),
	$model->title,
    ); 
}

$this->menu=array(
	array('label'=>'List Image', 'url'=>array('gallery/index')),
	array('label'=>'Create Image', 'url'=>array('create')),
	array('label'=>'Update Image', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Image', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Image', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php
    $url = "/images/" . $model->oldName;
    $img = CHtml::image($url, $model->title, array('width' => '200'));
    echo "<br>";
    echo CHtml::link($img, array('image/view', 'id' => $model->id));
?>
