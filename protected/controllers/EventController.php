<?php
class EventController extends Controller {

	public function actionView($id) {

		$userHasAccesToEvent = app()->gatekeeper->hasPostAccess('event', $id);

		if ($userHasAccesToEvent) {
			// Henter Event-info
			$sql = "SELECT e.id, e.title, e.start, e.end, e.imageId, e.location, n.content 
                    FROM event AS e LEFT JOIN news AS n ON n.parentId = e.id WHERE e.id=?";

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
        }
        else {
            $this->render("../site/403");
        }
	}
    
    public function actionFacebook( $id ) {
        $sql = "SELECT e.id, e.title, e.start, e.end, e.imageId, e.location, n.content 
		FROM event AS e LEFT JOIN news AS n ON n.parentId = e.id WHERE e.id = ?";

        $command = Yii::app()->db->createCommand($sql);
        $query = $command->query(array($id));
        $data = $query->read();

        $this->renderPartial('fbmetadata',$data);
    }
}