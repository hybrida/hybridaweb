<?php

$isAdmin = !Yii::app()->user->isGuest && Yii::app()->user->isAdmin;

$gridColumns = array(
    array(
        'name' => 'Forum',
        'headerHtmlOptions' => array('colspan' => '2'),
        'type' => 'html',
        'value' => 'CHtml::image(Yii::app()->controller->module->registerImage("on.gif"), "On")',
        'htmlOptions' => array('style' => 'width:22px;'),
    ),
    array(
        'name' => 'forum',
        'headerHtmlOptions' => array('style' => 'display:none'),
        'type' => 'html',
        'value' => '$data->renderForumCell()',
    ),
    array(
        'name' => 'threadCount',
        'headerHtmlOptions' => array('style' => 'text-align:center;'),
        'header' => 'Threads',
        'htmlOptions' => array('style' => 'width:65px; text-align:center;'),
    ),
    array(
        'name' => 'postCount',
        'headerHtmlOptions' => array('style' => 'text-align:center;'),
        'header' => 'Posts',
        'htmlOptions' => array('style' => 'width:65px; text-align:center;'),
    ),
    array(
        'name' => 'Last post',
        'headerHtmlOptions' => array('style' => 'text-align:center;'),
        'type' => 'html',
        'value' => '$data->renderLastpostCell()',
        'htmlOptions' => array('style' => 'width:200px; text-align:right;'),
    ),
);

if(isset($inforum) && $inforum == true)
    $preheader = '<div style="text-align:center;">Forums in "' . CHtml::encode($forum->title) . '"</div>';
else
    $preheader = CHtml::link(CHtml::encode($forum->title), $forum->url);

// Add some admin controls
if($isAdmin)
{
    $deleteConfirm = "Are you sure? All subforums and threads are permanently deleted as well!";

    $adminheader =
        '<div class="admin" style="float:right; font-size:smaller;">'.
            CHtml::link('New forum', array('/forum/forum/create', 'parentid'=>$forum->id)) .' | '.
            CHtml::link('Edit', array('/forum/forum/update', 'id'=>$forum->id)) .' | '.
            CHtml::ajaxLink('Delete category',
                array('/forum/forum/delete', 'id'=>$forum->id),
                array('type'=>'POST', 'success'=>'function(){document.location.reload(true);}'),
                array('confirm'=>$deleteConfirm)
            ).
        '</div>';

    $preheader = $adminheader . $preheader;

    // Admin links to show in extra column
    $gridColumns[] = array(
        'class'=>'CButtonColumn',
        'header'=>'Admin',
        'template'=>'{delete}{update}',
        'deleteConfirmation'=>"js:'".$deleteConfirm."'",
        'afterDelete'=>'function(){document.location.reload(true);}',
        'buttons'=>array(
            'delete'=>array('url'=>'Yii::app()->createUrl("/forum/forum/delete", array("id"=>$data->id))'),
            'update'=>array('url'=>'Yii::app()->createUrl("/forum/forum/update", array("id"=>$data->id))'),
        ),
        'htmlOptions' => array('style' => 'width:40px;'),
    );
}

$this->widget('forum.extensions.groupgridview.GroupGridView', array(
    'enableSorting' => false,
    'summaryText' => '',
    'selectableRows' => 0,
    'emptyText' => 'No forums found',
    'showTableOnEmpty'=>$isAdmin,
    'preHeader'=>$preheader,
    'preHeaderHtmlOptions' => array(
        'class' => 'preheader',
    ),
    'dataProvider'=>$subforums,
    'columns' => $gridColumns,
    'htmlOptions'=>array(
        'class'=>Yii::app()->controller->module->forumTableClass,
    )
));
