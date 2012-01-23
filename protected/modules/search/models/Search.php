<?php

class Search {

    private $pdo;
    
    public function __construct() {
        $this->pdo = Yii::app()->db->getPdoInstance();
    }
        
    public function searchUsers($search) {

            $limit = (isset($_GET['start']) && isset($_GET['interval'])) ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';


            $searchArray = preg_split('/ /', $search);
            $searchString = "";
            $data = array();

            for ($i = 0; $i < count($searchArray); $i++) {
                    if ($i > 0)
                            $searchString .= " AND";
                    $search = $searchArray[$i];
                    $searchString .= " (ui.username LIKE :search" . $i ." OR ui.firstName LIKE :search" . $i . " OR ui.middleName LIKE :search" . $i . " OR ui.lastName LIKE :search" . $i . ")";
                    $data['search' . $i] = $search . "%";
            }

            //Søke på brukere
            $sql = "SELECT DISTINCT ui.username, ui.id AS userId, ui.firstName, ui.middleName, ui.lastName 
            FROM hyb_user AS ui WHERE " . $searchString;

            $query = $this->pdo->prepare($sql);
            $query->execute($data);

            return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchNews($search) {

            //Søke på nyheter
            $data = array(
                    'search' => $search
            );

            $sql = "SELECT id, parentId, parentType, title, timestamp 
                    FROM news n
                    WHERE n.title REGEXP :search
                    ORDER BY timestamp DESC";

            $query = $this->pdo->prepare($sql);
            $query->execute($data);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $returnArray = Array();
            $i = 0;
            foreach ($result as $row){
                
                if( Yii::app()->gatekeeper->hasPostAccess('news', $row['id']) ){
                    $returnArray[$i++] = $row;
                }
            }
            
            return $returnArray;
    }

}