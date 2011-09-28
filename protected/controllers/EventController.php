<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventController
 *
 * @author sigurd
 */
class EventController extends Controller {

	public function actionView($id) {

		$eventId = $_GET['id'];
		$selfId = $_SESSION['self_id'];

		// DEtte er en sjekk om  personen har tillgang. GateKeeper skal ta seg av dette senere
		/*$sql = "SELECT id
	FROM event AS e 
	LEFT JOIN  " . accessId('event', $selfId) . " = e.id
	WHERE e.id='$eventId'";
		*/
		
		$userHasAccesToEvent = true; //GateKeeper::check(array());

		if ($userHasAccesToEvent) {

			// Henter Event-info
			$sql = "SELECT id, title, start, end, imageId, location, content 
		FROM event AS e WHERE id=?";
			
			$command = Yii::app()->db->createCommand($sql);
			$query = $command->query(array($id));
			$data = $query->read();
			
			// Henter Signup-info
			$sql = "SELECT eventId FROM signup WHERE eventId=?";
			$command = Yii::app()->db->createCommand($sql);
			$query = $command->query(array($id));
			$dataSignup = $query->read();
			
			$data['hasSignup'] = false;
			if (count($dataSignup) > 0 ) {
				$data['hasSignup'] = true;
			}
		}
		
		$this->render("view",$data);
			
	}

}

?>
