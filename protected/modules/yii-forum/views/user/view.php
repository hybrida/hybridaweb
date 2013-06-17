<?php
$this->widget('zii.widgets.CBreadcrumbs', array('links'=>array(
    'Forum'=>array('/forum'),
    $user->name
)));

$siglink = (!Yii::app()->user->isGuest && (Yii::app()->user->isAdmin || Yii::app()->user->forumuser_id == $user->id))?' ['. CHtml::link('Edit', array('user/update', 'id'=>$user->id)) .']':'';

$this->widget('zii.widgets.CDetailView', array(
    'data'=>$user,
    'attributes'=>array(
        'name',
        array(
            'label'=>'First seen',
            'value'=>Yii::app()->controller->module->format_date($user->firstseen),
        ),
        array(
            'label'=>'Last seen',
            'value'=>Yii::app()->controller->module->format_date($user->lastseen),
        ),
        'postCount',
        array(
            'label'=>'Profile',
            'type'=>'html',
            'value'=>isset(Yii::app()->controller->module->userUrl)?CHtml::link('Details', $this->evaluateExpression(Yii::app()->controller->module->userUrl, array('id'=>$user->siteid))):'n/a',
        ),
        array(
            'name'=>'signature',
            'label'=>'Signature'. $siglink,
            // 'type'=>'html',
        ),
    ),
    'htmlOptions'=>array(
        'class'=>Yii::app()->controller->module->forumDetailClass,
    )
));
