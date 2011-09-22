<?php
$this->breadcrumbs=array(
	'Message'=>array('message/index'),
	'HelloWorld',
);?>
<h1>Hello World</h1>
<h3><?=$time?></h3>
<p>
	<?= CHtml::link("Goodbye",array('message/goodbye')) ?> 
	
</p>