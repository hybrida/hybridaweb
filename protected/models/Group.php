<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property integer $menu
 * @property string $title
 * @property integer $admin
 * @property string $committee
 */
class Group extends CActiveRecord {

	/**
	 * Returns the static model of the specified AR class.
	 * @return Groups the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('menu, title', 'required'),
				array('menu, admin', 'numerical', 'integerOnly' => true),
				array('title', 'length', 'max' => 20),
				array('committee', 'length', 'max' => 5),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, menu, title, admin, committee', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
				'id' => 'ID',
				'menu' => 'Menu',
				'title' => 'Title',
				'admin' => 'Admin',
				'committee' => 'Committee',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('menu', $this->menu);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('admin', $this->admin);
		$criteria->compare('committee', $this->committee, true);

		return new CActiveDataProvider($this, array(
								'criteria' => $criteria,
						));
	}

	public function save($runValidation = true, $attributes = null) {
		return parent::save($runValidation, $attributes);
		// Logikk for å oppdatere menyen
	}

	// Bjørnars Group -------------------------------------------------------------------------------------------------------------------------------

	private $groupId;
	private $access;
	private $pdo;

	public function __construct() {
		$this->access = new Access();
		global $pdo;
		$this->pdo = $pdo;
	}

	
	  public function getTitle(){
          $this->pdo = Yii::app()->db->getPdoInstance();
          
          if(!isset($this->groupId)){
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
    public function isAdmin($userId){
        $this->pdo = Yii::app()->db->getPdoInstance();
        $data = array(
            'gID' => $this->id,
            'admin' => $userId
        );
        $sql = "SELECT COUNT(*) AS c FROM groups 
                WHERE id = :gID AND admin = :admin";
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        if($query->fetch(PDO::FETCH_ASSOC) < 1) {
            return false;
        }
        return true;
    }
      
	public function getMembers() {
        $this->pdo = Yii::app()->db->getPdoInstance();

		$data = array(
				'gID' => $this->id
		);
		$sql = "SELECT ui.userId,ui.firstName,ui.middleName,ui.lastName,mg.comission 
					FROM membership_group AS mg 
					LEFT JOIN user_info AS ui ON mg.userId=ui.userId 
					WHERE mg.groupId = :gID";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function addMember($userId, $comission) {
        $this->pdo = Yii::app()->db->getPdoInstance();
		$data = array(
				'gID' => $this->id,
				'uID' => $userId,
				'comission' => $comission
		);

		$sql = "INSERT INTO membership_group VALUES (:gID,:uID,:comission)";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		Access::insertMembership($this->id, $userId);
	}

	public function removeMember($userId) {

        $this->pdo = Yii::app()->db->getPdoInstance();
        
		$data = array(
				'gID' => $this->id,
				'uID' => $userId
		);

		$sql = "DELETE FROM membership_group WHERE groupId = :gID AND userId = :uID";
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
		$sql = "DELETE FROM membership_group WHERE groupId = :gID";
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
		$sql = "INSERT INTO groups VALUES (null ,  0,  :name,  :adminId,  'false')";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		$this->groupId = $this->pdo->lastInsertId();

		//Setter en accessdefinisjon til gruppen
		$accessDefID = $this->access->insertAccessDefinition($this->getGroupName());

		//echo  count($siteContent);
		$i = 0;
		foreach ($scFileArray as $sc) {

			$subId = $this->getSCId($sc);
			$data = array(
					'sc' => $sc,
					'subID' => $subId
			);

			echo "SubID:" . $subId;
			$sql = "INSERT INTO site VALUES (null, :sc,'group',:subID)";
			$query = $this->pdo->prepare($sql);
			$query->execute($data);

			$siteId = $this->pdo->lastInsertId();
			$data = array(
					'gID' => $this->id,
					'sID' => $siteId,
					'i' => $i++
			);

			$sql = "INSERT INTO menu_group VALUES (:gID, :sID,null,:i)";
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

    public function setTabPrivate($siteId){
        Access::deleteAllAccessRelation('site', $siteId);
        $groupAccess = Access::getAccessDefinition($this->getTitle());
        Access::insertAccessRelation($siteId, $groupAccess, 'site');
    }
    
    public function setTabOpen($siteId){
        Access::deleteAllAccessRelation('site', $siteId);
        
        $groupAccess = Access::getAccessDefinition($this->getTitle());
        Access::insertAccessRelation($siteId, $groupAccess, 'site');
        
        $loggedInAccess = Access::getAccessDefinition("logged_in");
        Access::insertAccessRelation($siteId, $loggedInAccess, 'site');
    }
    
    public function setTabPublic($siteId){
        Access::deleteAllAccessRelation('site', $siteId);
        
        $groupAccess = Access::getAccessDefinition($this->getTitle());
        Access::insertAccessRelation($siteId, $groupAccess, 'site');
        
        $loggedInAccess = Access::getAccessDefinition("logged_in");
        Access::insertAccessRelation($siteId, $loggedInAccess, 'site');
        
        $allAccess = Access::getAccessDefinition("all");
        Access::insertAccessRelation($siteId, $allAccess, 'site');
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
		RIGHT JOIN " . Access::innerSQLAllowedTypeIds() . " = s.siteId
		WHERE mg.group = :groupId
		ORDER BY mg.sort";

		$com = $this->pdo->prepare($sql);
		$com->bindValue(":groupId", $this->id);
		$com->bindValue(":userId", Yii::app()->user->id);
		$com->bindValue(":type", "site");

		$com->execute();

		$data = $com->fetchAll(PDO::FETCH_ASSOC);
	}

}