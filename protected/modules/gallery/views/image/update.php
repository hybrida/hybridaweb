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
	array('label'=>'List Image', 'url'=>array('/gallery/gallery/')),
	array('label'=>'Create Image', 'url'=>array('create')),
	array('label'=>'View Image', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Image', 'url'=>array('admin')),
);
?>

<h1>Update Image <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'gallery'=>$gallery, 'galleries'=>$galleries)); ?>