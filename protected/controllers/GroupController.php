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

	public function actionIndex() {

		$data = array();

		// Henter kommiteer
		$query = "SELECT g.url, g.id, g.title, menu.title AS menuTitle FROM groups AS g
                  LEFT JOIN 
                  (SELECT s.title, mg.group 
                  FROM menu_group AS mg 
                  LEFT JOIN site AS s ON s.siteId = mg.site 
                  WHERE mg.sort = (SELECT MIN(sort) FROM menu_group as mg)) AS menu
                  ON menu.group = g.id
                  WHERE committee = 'true'";

		$command = $this->pdo->prepare($query);
		$command->execute();

		$data['committee'] = $command->fetchAll(PDO::FETCH_ASSOC);

		// Henter grupper
		$query = "SELECT g.url, g.id, g.title, menu.title AS menuTitle FROM groups AS g
                  LEFT JOIN 
                  (SELECT s.title, mg.group 
                  FROM menu_group AS mg 
                  LEFT JOIN site AS s ON s.siteId = mg.site 
                  WHERE mg.sort = (SELECT MIN(sort) FROM menu_group as mg)) AS menu
                  ON menu.group = g.id
                  WHERE committee = 'false'";


		$command = $this->pdo->prepare($query);
		$command->execute();


		$data['groups'] = $command->fetchAll(PDO::FETCH_ASSOC);

		$this->render("index", $data);
	}

	public function actionView2($id, $title) {

		$data = array();
		$group = new Group($id);
		$data['id'] = $id;
		$data['model'] = $group;
		$data['title'] = $group->getTitle();
		$data['menu'] = $group->getMenu();

		$content = $group->getGroupContentType($title);

		if ($content == "article") {
			$data['content'] = $group->getArticle($title);
		}

		if ($content == "members") {
			$data['content'] = $group->getMembers();
			$data['date'] = date('Y');

			//Henter ut alle tidligere medlemmer av gruppen siden 2003
			//Bør gjøres ved hjelp av feed med en egen stil
			$former = array();
			$i = 0;
			for ($year = date('Y'); $year > 2003; $year--) {
				for ($s = 1; $s <= 2; $s++) {
					if (sizeof($group->getFormerMembers($year, $s)) > 0) {
						$former[$i++] = $group->getFormerMembers($year, $s);
					}
				}
			}

			$data['former'] = $former;
			print_r($former);
		}

		if ($content == "news") {
			$data['id'] = $group->id;
		}



		$this->render("view" . $content, $data);
	}

	public function actions() {
		return array(
				//'view' => 'application.controllers.group.ViewAction',
		);
	}

	public function actionEdit($id) {
		$group = new Group($id);
		$data['title'] = $group->getTitle();
		$data['groups'] = $group->getAdminMenu();
		$data['members'] = $group->getMembers();
		$data['menu'] = $group->getMenu();
		$this->render("edit", $data);
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
