<?php

class Profile {
	protected $pdo;

	public function info($id){
		$this->pdo = Yii::app()->db->getPdoInstance();

		$data = array(
			'id' => $id
		);

		$sql = "SELECT un.firstName, un.middleName, un.lastName, un.username, un.phoneNumber, un.specializationId,
				un.graduationYear, un.imageId, un.member, un.gender, un.cardHash, un.birthdate, un.altEmail, un.description,
				siteId, name FROM user AS un LEFT JOIN specialization ON specializationId = specialization.id WHERE un.id = :id";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		return $query->fetch(PDO::FETCH_ASSOC);

	}

	public function displayMembers($year){
		$this->pdo = Yii::app()->db->getPdoInstance();

		$data = array(
			'year' => $year
		);

		$sql = "SELECT ui.id, ui.username, ui.firstName, ui.middleName, ui.lastName, ui.imageId, ui.member, article_id, name
				FROM user AS ui
				LEFT JOIN specialization ON specializationId = specialization.id
				WHERE graduationYear = :year
				ORDER BY ui.firstName";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}
}