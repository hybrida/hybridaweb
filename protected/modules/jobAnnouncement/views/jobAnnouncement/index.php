<?php
$this->breadcrumbs=array(
	'Stillingsutlysninger'=>array('index'),
);

$this->renderPartial('_sidebar');

$this->menu=array(
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>
<div class="jobAnnouncementIndex">
	<h1>Stillingsutlysninger</h1>

	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
</div>