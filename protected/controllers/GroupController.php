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
		$query = "SELECT id,title FROM groups WHERE committee = 'true'";

		$command = $this->pdo->prepare($query);
		$command->execute();

		$data['committee'] = $command->fetchAll(PDO::FETCH_ASSOC);

		// Henter grupper
		$query = "SELECT id,title FROM groups WHERE committee = 'false'";


		$command = $this->pdo->prepare($query);
		$command->execute();

		$data['groups'] = $command->fetchAll(PDO::FETCH_ASSOC);

		$this->render("index", $data);
	}

	public function actionView($id, $sub) {

		$data = array();

		$group = Groups::model()->findByPk($id);
		$data['model'] = $group;
        $data['title'] = $group->getTitle();
		$this->render("view/comments", $data);
	}



	public function actions() {
		return array(
						//'view' => 'application.controllers.group.ViewAction',
		);
	}
    
    public function actionEdit($id){
        $group = Group::model()->findByPk($id);
        $data['title'] = $group->getTitle();
        $data['groups'] = $group->getAdminMenu();
        $data['members'] = $group->getMembers();
        
        $this->render("edit",$data);
        
    }
	
}

?>
