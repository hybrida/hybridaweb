<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:42
 */

$this->pageTitle = $model->title;

$form = $this->beginWidget('ActiveForm', array(
    'id' => 'poll_vote-form',
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'class' => 'g-form',
    ),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )));

$enabled = $model->status == 'enabled';

function array_any($array, $callback){
    foreach($array as $elem) if (call_user_func($callback, $elem)) return true;
    return false;
}

$optionsClasses = '';
if ($enabled) $optionsClasses .= ' enabled';
if (count($options) == 2 &&
        array_any($options, function($elem) {return $elem->option == 'yes';}) &&
        array_any($options, function($elem) {return $elem->option == 'no';}))
    $optionsClasses .=  ' yes-and-no';

?>

<h1><?=$this->pageTitle?></h1>

<div class="options<?=$optionsClasses?>">

<? foreach ($options as $option): ?>

<div class="row option <?=$option->option?><?=($voted == $option->option ? ' voted' : '')?>">
    <?= CHtml::submitButton(ucwords($option->option), array('name' => $option->option)) ?>
</div>

<?
endforeach;
$this->endWidget();
?>

</div>