<?php

abstract class AbstractFeed {

	private $offset;
	private $limit;
	private $count;
	private $gatekeeper;

	protected abstract function getActiveRecord($id);

	protected abstract function getType();

	protected abstract function getMaxElementCount();

	abstract protected function getSQL();

	public function __construct($limit, $offset = 0) {
		$this->offset = $offset;
		$this->limit = $limit;
		$this->count = $this->getMaxElementCount();
		$this->gatekeeper = app()->gatekeeper;
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
			$ar[] = $this->getActiveRecord($id);
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
			if ($this->gatekeeper->hasPostAccess($this->getType(), $id)) {
				$good[] = $id;
			} else {
				$this->offset++;
			}
		}
		return $good;
	}

	private function getRaw() {
		$start = $this->offset;
		$end = $this->offset + ($this->limit) * 2;
		$sql = $this->getSQL() . " LIMIT $start, $end";
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
