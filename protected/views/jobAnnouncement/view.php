<?php
$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'Update Job', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Job', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>
<div class="newsIndex">
<h1><?php echo $model->title; ?></h1>

<strong>Bedrift:</strong> <?=$model->company->name?><br/>
<strong>Startdato:</strong> <?= Html::dateToString($model->start) ?> <br/>
<strong>Sluttdato:</strong> <?= Html::dateToString($model->end) ?> <br/>
<h2>Beskrivelse</h2>
<?= $model->description ?>
</div>