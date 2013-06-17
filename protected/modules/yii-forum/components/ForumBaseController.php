<?php
/**
 * This is the base controller for any forum related contollers.
 * Its main reason for existance is it will populate the forumuser table, and
 * set the user state "forumuser_id" to a correct value.
 * All controllers in the foum module must extend from this base class.
 */
class ForumBaseController extends CController
{
	public function beforeAction($action)
	{
		// If user is guest, we have nothing to do, and if it's already
		// set, we're done
		if(Yii::app()->user->isGuest || isset(Yii::app()->user->forumuser_id)) return true;

		// See if we know who this is
		$forumuser = Forumuser::model()->findByAttributes(array(
			'siteid'=>Yii::app()->user->id,
		));

		// If it's not found, we'll add it, otherwise, just update lastseen
		if(null == $forumuser)
		{
			$forumuser = new Forumuser;
			$forumuser->siteid = Yii::app()->user->id;
			$forumuser->name = Yii::app()->user->name;
			$forumuser->firstseen = time();
			$forumuser->lastseen = time();
			$forumuser->save(false);
		} else {
			$forumuser->lastseen = time();
			$forumuser->save(false);
                }

                // Ad seet the user state
		Yii::app()->user->setState('forumuser_id', $forumuser->id);

		return true;
	}
}