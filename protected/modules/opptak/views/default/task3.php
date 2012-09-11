<h1>Du er ferdig</h1>

Nå som du er ferdig, får du muligheten til å ødelegge for resten.
Det du skriver i feltet under vil komme øverst på task2-siden


<?php
$form = $this->beginWidget('ActiveForm', array(
	'id' => 'news_edit-form',
	'htmlOptions' => array(
		'class' => 'g-form'
	),
		));
?>
<br/>
<div id="row">
	<?= $form->textArea($inject, 'content') ?>
</div>

<?= CHtml::submitButton('Ødelegg') ?>

<? $this->endWidget() ?>