<?php

class RbacTree extends CComponent {

	private $list;

	public function __construct() {
		$sql = "SELECT * FROM rbac_itemchild";
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $d) {
			$parent = $d['parent'];
			$child = $d['child'];

			$childrenList = $this->getChildren($parent);
			$childrenList[] = $d['child'];
			$this->list[$parent] = $childrenList;
		}
		asort($this->list);
		ksort($this->list);
	}

	public function getTree($parent) {
		$que = $this->list[$parent];
		$children = array();
		while (count($que) > 0) {
			$element = array_pop($que);
			$que += $this->getChildren($element);
			$children[] = $element;
		}
		asort($children);
		return $children;
	}

	private function getChildren($parent) {
		if (isset($this->list[$parent])) {
			return $this->list[$parent];
		} else {
			return array();
		}
	}

	public function getAll() {
		return $this->list;
	}


}