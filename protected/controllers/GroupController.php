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
		
		$query = "SELECT id,title FROM groups WHERE committee = 'true'";

		$command = $this->pdo->prepare($query);
		$command->execute();

		$data['committee'] = $command->fetchAll(PDO::FETCH_ASSOC);

		$query = "SELECT id,title FROM groups WHERE committee = 'false'";


		$command = $this->pdo->prepare($query);
		$command->execute();

		$data['groups'] = $command->fetchAll(PDO::FETCH_ASSOC);

		$this->render("index",$data);
	}

	public function actionView($id = null) {
		if ($id == null)
			echo "her kommer info om en spesiell side";
		else {
			echo "du har kommet inn på gruppeId: " . $id;
		}
	}

}

?>
