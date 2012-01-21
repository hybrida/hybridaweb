<?php
Yii::import('application.tests.testlib.TestLib');
function trace($name, $val="") {
	TestLib::trace($name, $val);
}
class NewsFeed {

	private $offset;
	private $limit;
	private $count;
	private $gatekeeper;

	public function __construct($limit, $offset = 0) {
		$this->offset = $offset;
		$this->limit = $limit;
		$this->count = News::model()->count();
		$this->gatekeeper = app()->gatekeeper;
		$this->initCriteria();
	}

	private function initCriteria() {

	}

	public function getElements() {
		$good = array();
		while (count($good) < $this->limit) {
			$good += $this->getNewPermissionsCheckedElements();
			if ($this->offset >= $this->count) {
				break;
			}
		}
		return $this->toActiveRecord($good);
	}
	
	private function toActiveRecord($newsIdArray) {
		$ar = array();
		foreach ($newsIdArray as $id) {
			$ar[] = News::model()->with('author')->findByPk($id);
		}
		return $ar;
	}

	private function getNewPermissionsCheckedElements() {
		$feedElements = $this->getRaw();
		$good = array();
		foreach ($feedElements as $id) {
			if (count($good) >= $this->limit) {
				break;
			}
			if ($this->gatekeeper->hasPostAccess('news', $id)) {
				$good[] = $id;
			} else {
				$ar = new AccessRelation('news', $id);
			}
		}
		return $good;
	}
	
	private function getRaw(){
		$start = $this->offset;
		$end = $this->offset + ($this->limit) * 2;
		$sql = "SELECT id FROM `news` 
				ORDER BY `timestamp` DESC
				LIMIT $start, $end";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
		$this->offset += $this->limit;
		return $data;
	}
	
	public function getLimit() {
		return $this->limit;
	}
	
	public function getOffset() {
		return $this->offset;
	}
}