<? $this->pageTitle = "Bedpres: ".$event->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<? 
$this->beginWidget('CClipWidget', array('id' => 'sidebar')); ?>
	<? $this->renderPartial("_attenders", array(
		'event' => $event,
	))  ?>
<?
$this->endWidget()
?>

<h1>Bedpres: <?=$event->title?></h1>

<img src='<?=$event->logo?>' alt=""/><br>

<?=$event->description?>

<?$this->widget('comment.components.commentWidget', array(
	'id' => $event->id,
	'type' => 'bedpres',
)); ?>

