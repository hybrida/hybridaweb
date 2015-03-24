<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:42
 */

$this->pageTitle = "$model->title";

$form = $this->beginWidget('ActiveForm', array(
    'id' => 'poll_vote-form',
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'class' => 'g-form',
    ),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )));

$this->endWidget();

?>

<h1><?=$this->pageTitle?></h1>

<div class="options">

<? foreach ($options as $option): ?>

<div class="row option">
    <?=$option->option?>
</div>

<? endforeach; ?>

</div>