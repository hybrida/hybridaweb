<?php

class Group {

	private $groupId;
	private $access;
	private $pdo;
	private $id;

	public function __construct($id) {
		$this->id = $id;
		$this->access = new Access();
		global $pdo;
		$this->pdo = $pdo;
	}

	public function getTitle() {
		$this->pdo = Yii::app()->db->getPdoInstance();

		if (!isset($this->groupId)) {
			$data = array(
				'gID' => $this->id
			);

			$sql = "SELECT title FROM groups WHERE id = :gID";
			$query = $this->pdo->prepare($sql);
			$query->execute($data);
			$data = $query->fetch();

			$this->groupId = $data['title'];
		}

		return $this->groupId;
	}

	/*
	  public function getGroupByID($gID){
	  $this->$groupId = $gID;
	  }
	  public function getGroupByName($gName){
	  $data = array(
	  'gName' => $gName
	  );

	  $sql = "SELECT id FROM groups WHERE title = :gName";
	  $query = $this->pdo->prepare($sql);
	  $query->execute($data);
	  $data = $query->fetch();

	  $this->$groupId = $data[id];
	  }
	  public function getTitle(){

	  $data = array(
	  'id' => $this->groupId
	  );

	  print_r($data);
	  echo "data:".$data;

	  $sql = "SELECT title FROM groups WHERE id = :id";
	  $query = $this->pdo->prepare($sql);
	  $query->execute($data);

	  $result = $query->fetch();
	  extract($result);
	  }
	 * 
	 */

	public function isAdmin($userId) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$data = array(
			'gID' => $this->id,
			'admin' => $userId
		);
		$sql = "SELECT COUNT(*) AS c FROM groups 
                WHERE id = :gID AND admin = :admin";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if ($result['c'] < 1) {
			return false;
		}
		return true;
	}

	public function getMembers() {


		$data = array(
			'gID' => $this->id
		);

		$sql = "SELECT un.id, un.imageId, un.firstName,un.middleName,un.lastName, mg.comission, mg.start, mg.end, un.username, un.phoneNumber, un.lastLogin, admin
                FROM group_membership AS mg LEFT JOIN hyb_user AS un ON mg.userId = un.id LEFT JOIN groups ON groups.id = :gID 
                WHERE mg.groupId = :gID AND (mg.end > DATE(NOW()) OR mg.end = '0000-00-00')";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function getFormerMembers($year, $semester) {

		//Definerer vår-/høstsemester.
		if ($semester == 1) {
			$start = "02";
			$end = "03";
		} else {
			$start = "08";
			$end = "09";
		}
		$data = array(
			'gID' => $this->id,
			'year1' => $year,
			'start' => $start,
			'year2' => $year,
			'end' => $end
		);

		$sql = "SELECT un.id, un.imageId, un.firstName,un.middleName,un.lastName,mg.comission, un.username, un.phoneNumber, un.lastLogin
                FROM group_membership AS mg 
                LEFT JOIN hyb_user AS un ON mg.userId = un.id
                WHERE mg.groupId = :gID
                AND mg.start >= (:year1-:start-15) AND mg.end >= (:year2-:end-15)";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$data = $query->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function getGroupContentType($title) {

		$data = array(
			'title' => $title
		);
		$sql = "SELECT sc.fileName FROM 
                site AS s LEFT JOIN site_content AS sc 
                ON s.subId = sc.id
                WHERE s.title = :title";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['fileName'];
	}

	public function getArticle($title) {
		$data = array(
			'title' => $title,
			'id' => $this->id
		);

		$sql = "SELECT a.title, a.content, a.timestamp, un.firstName, un.middleName, un.lastName FROM 
                menu_group AS mg
                LEFT JOIN site AS s ON mg.site = s.siteId
                LEFT JOIN site_content AS sc ON s.subId = sc.id
                LEFT JOIN article AS a ON a.id = mg.contentId 
                LEFT JOIN hyb_user AS un ON un.id = a.author
                WHERE mg.group = :id AND sc.filename = 'article' AND s.title = :title";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function addMember($userId, $comission) {
		$this->pdo = Yii::app()->db->getPdoInstance();

		$data = array(
			'gID' => $this->id,
			'uID' => $userId,
			'comission' => $comission
		);

		$sql = "INSERT INTO group_membership (groupId, userId, comission, start) VALUES (:gID,:uID,:comission,Now())";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$membership = new GroupMembership;
		$membership->groupId = $this->id;
		$membership->userId = $userId;
		$membership->save();
	}

	public function removeMember($userId) {

		$this->pdo = Yii::app()->db->getPdoInstance();

		$data = array(
			'gID' => $this->id,
			'uID' => $userId
		);

		$sql = "UPDATE group_membership WHERE groupId = :gID AND userId = :uID 
                        SET end = NOW()";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		Access::deleteMembership($this->id, $userId);
	}

	public function deleteGroup() {
		$this->pdo = Yii::app()->db->getPdoInstance();

		$dataGID = array(
			'gId' => $this->id
		);

		//Slette medlemmer fra gruppen
		$sql = "DELETE FROM group_membership WHERE groupId = :gID";
		$query = $this->pdo->prepare($sql);
		$query->execute($dataGID);

		$sql = "SELECT site FROM menu_group WHERE group = :gID";
		$query = $this->pdo->prepare($sql);
		$query->execute($dataGID);
		$rows = $query->fetchAll();

		foreach ($rows as $row) {
			//Slette tilgangsnivåer til gruppen
			$this->access->deleteAccessRelation('site', $rows[site]);

			//Slette sites som hører til gruppen
			$data = array(
				'id' => $rows[site]
			);

			$sql = "DELETE FROM site WHERE id = :id";
			$query = $this->pdo->prepare($sql);
			$query->execute($data);
		}

		//Slette menyer som hører til gruppen
		$sql = "DELETE FROM menu_group WHERE group = :gID";
		$query = $this->pdo->prepare($sql);
		$query->execute($dataGID);

		//Slette gruppe tilgangsnivået
		$this->access->deleteAccessDefinition($this->getGroupName());

		//Slette gruppen
		$sql = "DELETE FROM groups WHERE id = :gID";
		$query = $this->pdo->prepare($sql);
		$query->execute($dataGID);
	}

	public function createGroup($name, $adminId, $siteContents, $scFileArray) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$this->article = new Article();

		//Standardfaner for grupper
		//$siteContent = array("Kommentarer","Nyheter","Info","Medlemmer");
		//$siteContentFile = array("comments","news","article","members");

		$data = array(
			'name' => $name,
			'adminId' => $adminId
		);

		//Oppretter gruppen
		$sql = "INSERT INTO group  (`id` ,`title` ,`content` ,`author` ,`timestamp`) 
				VALUES (null ,  0,  :name,  :adminId,  'false')";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$this->groupId = $this->pdo->lastInsertId();

		//Setter en accessdefinisjon til gruppen
		$accessDefID = $this->access->insertAccessDefinition($this->getGroupName());

		//echo  count($siteContent);
		$sortOrder = 0;
		foreach ($scFileArray as $sc) {

			$subId = $this->getSCId($sc);
			$data = array(
				'sc' => $sc,
				'subID' => $subId
			);

			echo "SubID:" . $subId;
			$sql = "INSERT INTO site (`siteId` ,`title` ,`path` ,`id` ,`subId`) 
				VALUES (null, :sc,'group',:subID)";
			$query = $this->pdo->prepare($sql);
			$query->execute($data);

			$siteId = $this->pdo->lastInsertId();
			$data = array(
				'gID' => $this->id,
				'sID' => $siteId,
				'i' => $sortOrder++
			);

			$sql = "INSERT INTO menu_group(`group` ,`site` ,`contentId` ,`sort`)	
					VALUES (:gID, :sID,null,:i)";
			$query = $this->pdo->prepare($sql);
			$query->execute($data);

			echo $siteId . "<br>";

			$data = array(
				'sID' => $siteId
			);

			$this->access->insertAccessRelation($siteId, 1, 'site');
			$this->access->insertAccessRelation($siteId, 2, 'site');
			$this->access->insertAccessRelation($siteId, $accessDefID, 'site');
		}

		$articleId = $this->article->insert('Info', 'Informasjon om gruppen', 327);
		$this->updateArticle($articleId, $siteId);
	}

	public function insert($attributes = null) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		parent::insert($attributes);

		// ACCESS
	}

	public function updateArticle($articleId, $siteId) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$data = array(
			'aID' => $articleId,
			'gID' => $this->id,
			'sID' => $siteId
		);

		echo "GROUP ID:" . $this->id;

		//OBS! Denne er sannsynligvis skikkelig dårlig skrevet
		$sql = "UPDATE menu_group AS mg SET mg.contentId = :aID WHERE mg.group= :gID AND mg.site IN 
        (SELECT s.siteId FROM site AS s LEFT JOIN site_content AS sc ON s.subId = sc.id WHERE sc.fileName='article' AND s.site = :sID)";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);
	}

	public function getAdminMenu() {
		$this->pdo = Yii::app()->db->getPdoInstance();

		$data = array(
			'gID' => $this->id
		);
		//Eksempel:
		//Tittel      | public  |  closed
		//Diskusjon   |    0    |    1    
		//Medlemmer   |    0    |    0
		//Informasjon |    1    |    0
		//Output tittel og om det er en privat side
		//$titleGroup
		//$idGroup
		//$openGroup (null => Lukket, 1 => Åpen for medlemmer)
		//$publicGroup (null => Åpen for medlemmer, 1 => Public)
		$sql = "SELECT DISTINCT :gID AS id,s.siteId AS siteId, public.public AS publicGroup, priv.notPriv AS openGroup, s.title AS titleMenu FROM menu_group AS mg LEFT JOIN site AS s ON s.siteId = mg.site 
        LEFT JOIN (SELECT 1 as notPriv,s.siteId AS sId FROM groups AS g, access_definition AS ad
        LEFT JOIN access_relations AS ar ON ad.id = ar.access RIGHT JOIN site AS s
        ON s.siteId = ar.id WHERE g.id = :gID AND ad.description != g.title) AS priv ON priv.sId = s.siteId 

        LEFT JOIN (SELECT 1 as public,s.siteId AS sId FROM groups AS g, access_definition AS ad
        LEFT JOIN access_relations AS ar ON ad.id = ar.access RIGHT JOIN site AS s
        ON s.siteId = ar.id WHERE g.id = :gID AND ad.description = 'all') AS public ON public.sId = s.siteId
        WHERE mg.group = :gID
		ORDER BY mg.sort";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		//print_r($result);
		return $result;
	}

	public function setTabPrivate($siteId) {
		Access::deleteAllAccessRelation('site', $siteId);
		$groupAccess = Access::getAccessDefinition($this->getTitle());
		Access::insertAccessRelation('site', $siteId, $groupAccess);
	}

	public function setTabOpen($siteId) {
		Access::deleteAllAccessRelation('site', $siteId);

		$groupAccess = Access::getAccessDefinition($this->getTitle());
		Access::insertAccessRelation('site', $siteId, $groupAccess);

		$loggedInAccess = Access::getAccessDefinition("logged_in");
		Access::insertAccessRelation('site', $siteId, $loggedInAccess);
	}

	public function setTabPublic($siteId) {
		Access::deleteAllAccessRelation('site', $siteId);

		$groupAccess = Access::getAccessDefinition($this->getTitle());
		Access::insertAccessRelation('site', $siteId, $groupAccess);

		$loggedInAccess = Access::getAccessDefinition("logged_in");
		Access::insertAccessRelation('site', $siteId, $loggedInAccess);

		$allAccess = Access::getAccessDefinition("all");
		Access::insertAccessRelation('site', $siteId, $allAccess);
	}

	//Hente ut id til siteContent
	private function getSCId($var) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$data = array(
			'var' => $var
		);

		$sql = "SELECT sc.id AS ID FROM site_content AS sc WHERE sc.filename = :var";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['ID'];
	}

	/**
	 *
	 * Returnerer en indre sql-query som henter tillate typeIder basert på :type og :userId. 
	 * Søker gjennom blant annet access_relations og membership_access
	 * 
	 * HUSK! legg til :type og :userId i parameterlisten på PDOStatement::execute(parameter)
	 * 
	 * 
	 * @return type string
	 */

	/**
	 *
	 * @return array Liste over menyer brukeren har lov til å se
	 */
	public function getMenu() {

		$this->pdo = Yii::app()->db->getPdoInstance();
		$sql = "SELECT DISTINCT subId, s.title, mg.contentId AS aId FROM menu_group AS mg LEFT JOIN site AS s ON s.siteId = mg.site 
		WHERE mg.group = :groupId
		ORDER BY mg.sort";

		$com = $this->pdo->prepare($sql);
		$com->bindValue(":groupId", $this->id);

		$com->execute();

		$data['menuelements'] = $com->fetchAll(PDO::FETCH_ASSOC);
		$data['id'] = $this->id;
		$data['isAdmin'] = $this->isAdmin(Yii::app()->user->id);

		return $data;
	}

}