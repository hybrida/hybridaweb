<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:42
 */

$this->pageTitle = "Rediger avstemning";

$form = $this->beginWidget('ActiveForm', array(
    'id' => 'poll_edit-form',
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'class' => 'g-form',
    ),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )));

$statuses = explode(',', Poll::STATUSES);
$statuses_assoc = array_combine($statuses, $statuses);

?>

<h1><?=$this->pageTitle?></h1>

<div class="row">
    <?= $form->labelEx($model, 'Tittel') ?>
    <?= $form->textField($model, 'title') ?>
    <?= $form->error($model, 'title') ?>
</div>

<div class="row">
    <?= $form->labelEx($model, 'Status') ?>
    <?= $form->radioButtonList($model, 'status', $statuses_assoc) ?>
    <?= $form->error($model, 'status') ?>
</div>

<div class="row">
    <?= $form->labelEx($model, 'Offentlig (resultat)') ?>
    <?= $form->radioButtonList($model, 'public',
        array('false' => 'false', 'true' => 'true'), array('default' => '0')) ?>
    <?= $form->error($model, 'public') ?>
</div>

<div class="options">

<? // foreach () ?>
<!--
<div class="row option">
    <?= $form->labelEx($model, 'Alternativer') ?>
    <?= $form->radioButtonList($model, 'public',
        array('false' => 'false', 'true' => 'true'), array('default' => '0')) ?>
    <?= $form->error($model, 'public') ?>
</div>
-->
</div>

<?php echo CHtml::submitButton('Lagre', array(
    'class'=> 'g-button'
)); ?>

<? $this->endWidget() ?>
