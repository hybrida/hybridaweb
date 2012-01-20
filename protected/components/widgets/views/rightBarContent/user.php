<img class='block' src="<?= Yii::app()->request->baseUrl ?>/image/view/id/<?=$imageId ?>/size/1" width="248px">

<div class='barText'></div>
  
<? $this->widget('application.components.widgets.ActivitiesCalendar'); ?>
<? $this->widget('application.components.widgets.ActivitiesFeed'); ?>