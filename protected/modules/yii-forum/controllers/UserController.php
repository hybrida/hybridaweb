<?php

class UserController extends ForumBaseController
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
                'actions' => array('view'),
                'users' => array('*'),
            ),
            // authenticated users
            array('allow',
                'actions' => array('update'),
                'users' => array('@'),
            ),
/*

            // administrators
            array('allow',
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'), // Must be authenticated
                'expression' => 'Yii::app()->user->isAdmin', // And must be admin
            ),
*/

            // deny all users
            array('deny', 'users'=>array('*')),
        );
    }

    /**
     * Shows the given user's profille
     */
    public function actionView($id)
    {
        $user = Forumuser::model()->findByPk($id);
        if(null == $user)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->render('view',array(
            'user'=>$user,
        ));
    }

    /**
     * Edit a user's information (signature)
     */
    public function actionUpdate($id)
    {
        // A user can onbly edit themselves, unless they're admin of course
        if(Yii::app()->user->isGuest || (
                !Yii::app()->user->isAdmin &&
                ($id!=Yii::app()->user->forumuser_id)
        ))
            throw new CHttpException(403, 'You are not allowed to view this page.');

        $user = Forumuser::model()->findByPk($id);
        if(null == $user)
            throw new CHttpException(404, 'The requested page does not exist.');

        if(isset($_POST['Forumuser']))
        {
            $user->attributes=$_POST['Forumuser'];
            if($user->validate())
            {
                $user->save(false);
                $this->redirect($user->url);
            }
        }

        $this->render('update', array(
            'model'=>$user,
        ));
    }
}
