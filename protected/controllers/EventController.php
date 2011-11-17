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

        $gateKeeper = new GateKeeper();
		$userHasAccesToEvent = $gateKeeper->hasAccess('event', $id);

		/*if ($userHasAccesToEvent) {*/
        //Fjernet inntill gjest kan ha access
			// Henter Event-info
			$sql = "SELECT id, title, start, end, imageId, location, content 
		FROM event AS e WHERE id=?";

			$command = Yii::app()->db->createCommand($sql);
			$query = $command->query(array($id));
			$data = $query->read();

            $data['hasSignup'] = false;
            
            $array = array(
                'eID' => $id
            );
            
            $sql = "SELECT COUNT(*) AS c FROM signup WHERE eventId = :eID";
            $query = Yii::app()->db->getPdoInstance()->prepare($sql);
            $query->execute($array);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            if($result['c'] > 0) {
                // Henter Signup-info
                $sql = "SELECT spots, open, close FROM signup WHERE eventId = :eID";
                $query = Yii::app()->db->getPdoInstance()->prepare($sql);
                $query->execute($array);

                $result = $query->fetch(PDO::FETCH_ASSOC);

                $data['hasSignup'] = true;
                $data['spots'] = $result['spots'];
                $data['open'] = $result['open'];
                $data['close'] = $result['close'];
            }

            $this->render("view", $data);
        /*}
        else {
            $this->render("../site/403");
        }*/
	}
}