<?php

class ForumController extends ForumBaseController
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl');
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            // ALL users
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
/*
            // authenticated users
            array('allow',
                'actions' => array(),
                'users' => array('@'),
            ),
*/

            // administrators
            array('allow',
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'), // Must be authenticated
                'expression' => 'Yii::app()->user->isAdmin', // And must be admin
            ),

            // deny all users
            array('deny', 'users'=>array('*')),
        );
    }

    /**
     * This is basically the "homepage" for the forums
     * It'll show a list of root categories which forums in each
     */
    public function actionIndex()
    {
        // Dataproviders for forums in each category will be created on the fly
        // This may be a good candidate for eager loading...
        $this->render('index',array(
            'categories'=>Forum::model()->categories()->findAll(),
        ));
    }

    /**
     * Shows the content of a forum. First a list of subforums, followed by a
     * list of threads in this forum
     */
    public function actionView($id)
    {
        $forum = Forum::model()->findByPk($id);
        if(null == $forum)
            throw new CHttpException(404, 'The requested page does not exist.');

        $subforumsProvider = new CActiveDataProvider('Forum', array(
            'criteria'=>array(
                'scopes'=>array('forums'=>array($id)),
            ),
            'pagination'=>false,
        ));

        $threadsProvider = new CActiveDataProvider('Thread', array(
            'criteria'=>array(
                'condition'=>'forum_id='. $forum->id,
            ),
            'pagination'=>array(
                'pageSize'=>Yii::app()->controller->module->threadsPerPage,
            ),
        ));

        $this->render('view',array(
            'forum'=>$forum,
            'subforumsProvider'=>$subforumsProvider,
            'threadsProvider'=>$threadsProvider,
        ));
    }

    /**
     * create action
     */
    public function actionCreate($parentid=null)
    {
        $forum=new Forum;
        $forum->parent_id = $parentid; // Set default

        if(isset($_POST['Forum']))
        {
            $forum->attributes=$_POST['Forum'];
            if($forum->validate())
            {
                if((int)$forum->parent_id < 1) $forum->parent_id = null;
                $forum->save();
                $this->redirect($forum->url);
            }
        }
        $this->render('editforum', array('model'=>$forum));
    }

    /**
     * Update action
     * @param type $id Id of forum to edit.
     * @throws CHttpException if forum not found
     */
    public function actionUpdate($id)
    {
        $forum = Forum::model()->findByPk($id);
        if(null == $forum)
            throw new CHttpException(404, 'The requested page does not exist.');

        if(isset($_POST['Forum']))
        {
            $forum->attributes=$_POST['Forum'];
            if($forum->validate())
            {
                if((int)$forum->parent_id < 1) $forum->parent_id = null;
                $forum->save();
                $this->redirect($forum->url);
            }
        }
        $this->render('editforum', array('model'=>$forum));
    }

    /**
     * deleteForum action
     * Deletes both categories or forums.
     * Will take all subforums, threads and posts inside with it!
     */
    public function actionDelete($id)
    {
        if(!Yii::app()->request->isPostRequest || !Yii::app()->request->isAjaxRequest)
            throw new CHttpException(400, 'Invalid request');

        // First, we make sure it even exists
        $forum = Forum::model()->findByPk($id);
        if(null == $forum)
            throw new CHttpException(404, 'The requested page does not exist.');

        $forum->delete();
    }

}