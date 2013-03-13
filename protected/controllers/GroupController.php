<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupController
 *
 * @author sigurd
 */
class GroupController extends Controller {

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('index', 'members', 'view'),
				'users' => array('@'),
			),
			array('allow',
				'actions'=> array('editMembers', 'editMembership'),
			),
			array('deny'),
		);
	}

	public function actionIndex() {
		$groups = Groups::model()->findAll();
		$this->render('index', array(
			'groups' => $groups,
		));
	}

	public function actionEditMembers($url) {
		$group = $this->getGroupByUrl($url);
		$this->checkAccessToGroupOrThrowException($group->id);
		$groupForm = new GroupMembersForm($group);
		$members = $group->getActiveMemberships();
		$this->saveIfPostRequest($groupForm);
		$this->render("editMembers", array(
			'group' => $group,
			'groupForm' => $groupForm,
			'members' => $members,
		));
	}

	private function checkAccessToGroupOrThrowException($groupId) {
		if (!user()->checkAccess('updateGroup', array('id' => $groupId))) {
			throw new CHttpException(403, "Du har ikke tilgang til å redigere denne gruppen");
		}
	}

	private function getGroupByUrl($url) {
		$group = Groups::model()->find("url = ?", array($url));
		if (!$group)
			throw new CHttpException(404, "Gruppen finnes ikke");
		return $group;
	}

	private function saveIfPostRequest($groupForm) {
		if (Yii::app()->request->isPostRequest && isset($_POST['GroupMembersForm'])) {
			$input = $_POST['GroupMembersForm'];
			var_export($input);
			$groupForm->setAttributes($input);
			$groupForm->save();
			$this->redirect("editMembers");
		}
	}

	public function actionEditMembership($url, $userId) {
		$group = $this->getGroupByUrl($url);
		$user = User::model()->findByPk($userId);
		$this->checkAccessToGroupOrThrowException($group->id);
		$condition = "groupId = :groupId AND userId = :userId AND end = :end";
		$membership = GroupMembership::model()->find($condition, array(
			'groupId' => $group->id,
			'userId' => $userId,
			'end' => Groups::STILL_ACTIVE,
				));
		$shouldRedirect = $this->saveMembershipIfPostRequest($membership);
		if ($shouldRedirect) {
			$url = $this->createUrl("editMembers", array('url' => $url));
			$this->redirect($url);
		}
		$this->render('editMembership', array(
			'group' => $group,
			'user' => $user,
			'model' => $membership,
		));
	}

	private function saveMembershipIfPostRequest($membership) {
		if ( isset($_POST['GroupMembership']) ) {
			$input = $_POST['GroupMembership'];
			$membership->setAttributes($input);
			return $membership->save();
		}
		return false;
	}

	public function actionMembers($url) {
		$group = $this->getGroupByUrl($url);
		$this->render('members', array(
			'group' => $group,
			'members' => $group->getActiveMemberships(),
		));

	}

	public function actionView($url) {
		$this->actionMembers($url);
	}

}
