<?php

class EventController extends Controller {

	public function actionFacebook($id) {
		$sql = "SELECT e.id, e.title, e.start, e.end, e.imageId, e.location, n.content
		FROM event AS e LEFT JOIN news AS n ON n.parentId = e.id WHERE e.id = ?";

		$command = Yii::app()->db->createCommand($sql);
		$query = $command->query(array($id));
		$data = $query->read();

		$this->renderPartial('fbmetadata', $data);
	}

}