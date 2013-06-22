<?php

class RbacTree extends CComponent {

	private $list;
	private $items;

	public function __construct() {
		$this->getItemChildren();
		$this->getItems();
	}

	private function getItemChildren() {
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

	private function getItems() {
		$sql = "SELECT * FROM rbac_item";
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $assocItem) {
			$bizRule = $assocItem['bizrule'];
			$name = $assocItem['name'];
			$item = new RbacItem($name, $bizRule);
			$this->items[] = $item;
		}
	}

	public function getTree($parent) {
		$root = new TreeItem($parent);
		$que = array($root);
		while(count($que) > 0) {
			$current = array_pop($que);
			$rbacItem = $this->getRbacItem($current->name);
			$current->bizRule = $rbacItem->bizRule;
			$children = $this->getChildren($current->name);
			foreach ($children as $child) {
				$item = new TreeItem($child);
				$que[] = $item;
				$current->children[] = $item;
			}
		}
		return $root;
	}

	private function makeRed($name) {
		return "<div style='color: red'>$name</div>";
	}

	private function getChildren($parent) {
		if (isset($this->list[$parent])) {
			return $this->list[$parent];
		} else {
			return array();
		}
	}

	private function getRbacItem($search) {
		foreach ($this->items as $item) {
			if ($item->name == $search) {
				return $item;
			}
		}
		throw new CException("Fant ikke til $search");
	}

	public function getAll() {
		return $this->list;
	}

}

class RbacItem {
	public $name;
	public $bizRule;

	public function __construct($name, $bizRule) {
		$this->name = $name;
		$this->bizRule = $bizRule;
	}
}

class TreeItem {
	public $name;
	public $bizRule;
	public $children = array();

	public function __construct($name) {
		$this->name = $name;
	}

	public function hasBizRule() {
		return $this->bizRule != null && $this->bizRule != "";
	}
}