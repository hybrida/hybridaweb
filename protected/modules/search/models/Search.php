<?php

class Search {

	private function searchUsers() {

		$limit = (isset($_GET['start']) && isset($_GET['interval'])) ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';

		if (strlen($_GET['q']) < 1) {
			die("");
		}

		$searchArray = preg_split('/ /', $_GET['q']);
		$searchString = "";
		$data = array();

		for ($i = 0; $i < count($searchArray); $i++) {
			if ($i > 0)
				$searchString .= " AND";
			$search = $searchArray[$i];
			$searchString .= " (ui.firstName LIKE :search" . $i . " OR ui.middleName LIKE :search" . $i . " OR ui.lastName LIKE :search" . $i . ")";
			$data['search' . $i] = $search . "%";
		}

		//Søke på brukere
		$sql = "SELECT DISTINCT ui.id AS userId, ui.firstName, ui.middleName, ui.lastName 
            FROM hyb_user AS ui WHERE " . $searchString;

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	private function searchNews() {

		//Søke på nyheter
		$data = array(
			'userId' => Yii::app()->user->id,
			'type' => 'news',
			'search' => $search
		);

		$sql = "SELECT id, parentId, parentType, title, timestamp 
            FROM news n 
            RIGHT JOIN " . Access::innerSQLAllowedTypeIds() . " = n.id 
            WHERE n.title REGEXP :search
            ORDER BY timestamp DESC";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

}