<? $this->pageTitle = "Bedpres: ".$event->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<? 
$this->beginClip('sidebar'); ?>
	<? $this->renderPartial("_attenders", array(
		'event' => $event,
	))  ?>
<? $this->endClip() ?>

<h1>Bedpres: <?=$event->title?></h1>

<img src='<?=$event->logo?>' alt=""/><br>

<?=$event->description?>