<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetController
 *
 * @author Media
 */

class GetController extends Controller{
    //put your code here
    
    private function albumList() {
        $result = query("SELECT id, title, imageId FROM album AS a 
			RIGHT JOIN  ".accessId('news',$selfId)." = n.id
			WHERE owner = $userId");
			while( $row = mysql_fetch_array( $result ) ) {
				p("<img src='/php/image.php?id=$row[imageId]&size=2' />$split2$row[title]$split2$row[id]$split");
			}
            $this->renderPartial("index");
    }
    
    public function actionDebug() {
        print_r($_GET);
    }
    
    public function actionFeed(){
        $contentLength = 500;
        $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';
        

        //Feil å bruke parentType for selection. 
        if ( !isset($_GET['parentType'])) {			
            $sql = "SELECT DISTINCT ui.userId AS userId, n.id AS id,parentId, parentType, n.title, n.imageId AS imageId, content, firstName, middleName, lastName, timestamp 
                        FROM news n JOIN user_info ui ON n.author = ui.userId 
                        RIGHT JOIN " . Access::innerSQLAllowedTypeIds() . " = n.id 
                        ORDER BY timestamp DESC " . $limit;
            
            $data = array(
                'userId' => 327,
                'type' => 'news'
                    
        );
        }
        else {
            $sql = "SELECT DISTINCT ui.userId AS userId, n.id AS id,parentId, parentType, n.title, n.imageId AS imageId, content, firstName, middleName, lastName, timestamp FROM news n
                        RIGHT JOIN (SELECT ar.id AS accessId, ma.userId FROM membership_access ma LEFT JOIN access_relations ar ON ma.accessId=ar.access WHERE ar.type='news' AND ma.userId = 327) AS a ON a.accessId = n.id 
                        RIGHT JOIN tag AS t ON t.id = n.id 
                        LEFT JOIN groups AS g ON g.id = t.ownerId 
                        LEFT JOIN user_info ui ON n.author = ui.userId
                        WHERE g.id = :id AND t.contentType = 'news' AND t.tagType = 'group'";
            
            $data = array(
                'id' => $_REQUEST['id'],
                );
        }
        
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        $data['newslist'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['contentLength'] = $contentLength;
        $this->renderPartial('feed',$data);
        
    }
    
    public function actionComment(){
            $split = '~%~';
			$pId = $_REQUEST['id'];
			$pType = $_REQUEST['parentType'];
            
			$data['html'] = $this->comment($pType,$pId,$split);	
            $this->renderPartial('comment',$data);
    }
    
    //List nested comments
    private function comment($pType,$pId,$split) {
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'userId' => Yii::app()->user->id,
            'type' => 'comment',
            'id' => $pId,
            'pType' => $pType
        );
        echo Yii::app()->user->name;

        $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';

        $sql = "SELECT u.imageId, c.id, c.content, c.timestamp, u.firstName, u.middleName, u.lastName 
        FROM comment AS c JOIN user_info AS u ON c.author = u.userId
        RIGHT JOIN " . Access::innerSQLAllowedTypeIds() . " = c.id
        WHERE c.parentType = :pType AND c.parentId = :id 
        ORDER BY c.timestamp DESC " . $limit;

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);


        $output = "";
        foreach( $result as $row ) {
            $image = ($row['path'] ? $row['path'] : "images/user/unknown.jpg");
            $content = $row['content'];
            $output .= "<img src='php/image.php?id=$row[imageId]&size=2' />";
            $output .= $content;
            $output .= "<div class='author'><i>skrevet av: $row[firstName] $row[middleName] $row[lastName] den: $row[timestamp]</i></div>";
            $output .= comment('comment',$selfId,'¤£');		//Print 2.nivåkommentarer
            $output .= $split;
        }
        return $output;
    }
    
    public function actionEvent($id){
		$split = '~%~';
        $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';
        
        $data = array(
            'userId' =>  Yii::app()->user->id,
            'type' => 'event'
        );
          
        $sql = "SELECT e.id AS id, e.start AS start, e.title AS title
        FROM event AS e 
        RIGHT JOIN  " . Access::innerSQLAllowedTypeIds() . " = e.id 
        WHERE start >= NOW()
        ORDER BY start $limit";
         
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        
    
        $data['events'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['split'] = $split;
        
        $this->renderPartial('event',$data);
    }
    
    public function actionSignup($id){
        $split = '~%~';
        $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';
        
        $input = array(
            'userId' =>  Yii::app()->user->id,
            'type' => 'event',
            'id' => $_REQUEST['id']
        );
 
        $sql = "SELECT ui.userId, ui.firstName, ui.middleName, ui.lastName 
        FROM membership_signup AS ms LEFT JOIN user_info AS ui ON ms.userId = ui.userId LEFT JOIN event as e ON e.id=ms.eventId
        RIGHT JOIN ". Access::innerSQLAllowedTypeIds() . " = e.id
        WHERE ms.signedOff='false' AND ms.eventId=:id ORDER BY ui.graduationYear";

        $query = $this->pdo->prepare($sql);
        $query->execute($input);
        
        $data['list'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['id'] = $id;
        
        $input = array(
            'id' => $_REQUEST['id']
        );
        $sql = "SELECT userId FROM membership_signup WHERE eventId = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute($input);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($result['userId'] == Yii::app()->user->id ){
            $data['signType'] = "on";
            $data['buttonText'] = "Meld meg på";
        }
        else
        {
            $data['signType'] = "off";
            $data['buttonText'] = "Meld meg av";
        }
        
        $this->renderPartial('signup',$data);
    }
    
    public function actionGroup(){
        $gId = $_REQUEST['gId'];
        $type = $_REQUEST['type'];
        
        
        $group = Groups::model()->findByPk($gId);
        if($group->isAdmin( Yii::app()->user->id )){
            if ($type == 'delMember'){
                $group->removeMember( $_REQUEST['userId'] );
            }
            if($type == 'addMember'){
                $group->addMember( $_REQUEST['userId'] , $_REQUEST['commission'] );
            }
            
            if($type == 'modTabAccess'){
                if($_REQUEST['access'] == 'private'){
                    $group->setTabPrivate($_REQUEST['siteId']);
                }
                if($_REQUEST['access'] == 'open'){
                    $group->setTabOpen($_REQUEST['siteId']);
                }
                if($_REQUEST['access'] == 'public'){
                    $group->setTabPublic($_REQUEST['siteId']);
                }
            }
        }
        $this->renderPartial('group');
    }
    public function actionSearch(){
            $split = '~%~';
            $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';
            
            if(strlen($_GET['q']) < 1) {
                die("");
            }
            
			$searchArray = preg_split( '/ /', $_GET['q'] );
			$searchString = "";
            $data = array();
            
            for( $i = 0; $i < count( $searchArray ); $i++ ) {
				if( $i > 0 ) $searchString .= " AND";
				$search = $searchArray[$i];
				$searchString .= " (ui.firstName LIKE :search".$i." OR ui.middleName LIKE :search".$i." OR ui.lastName LIKE :search".$i.")";
                $data['search' . $i] = $search . "%";
			}
            
			//Søke på brukere
			$sql = "SELECT DISTINCT ui.userId, ui.firstName, ui.middleName, ui.lastName 
                    FROM user_info AS ui WHERE " . $searchString;
            
			$query = $this->pdo->prepare($sql);
            $query->execute($data);
            
            $result['users'] = $query->fetchAll(PDO::FETCH_ASSOC);
            $result['split'] = $split;

			//Søke på nyheter
            $data = array(
                'userId' => Yii::app()->user->id,
                'type'   => 'news',
                'search' => $search
            );
            
			$sql = "SELECT id, parentId, parentType, title, timestamp 
			FROM news n 
			RIGHT JOIN " . Access::innerSQLAllowedTypeIds() . " = n.id 
			WHERE n.title REGEXP :search
			ORDER BY timestamp DESC";
            
			$query = $this->pdo->prepare($sql);
            $query->execute($data);
            $result['newsList'] = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $this->renderPartial('search',$result);
    }
    
    public function actionIndex() {
	
	$split = "¤¤";
	$split2 = "¤£";
	
	
	$limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? " LIMIT " . $_GET['start'] . ", " . $_GET['interval'] : "";
	$userId = (isset($_GET['userid']) ? $_GET['userid'] : $selfId);
	$selfId = (($_SESSION['logged_in']==true) ? $_SESSION['self_id'] : 406);		//406 er besøkende
	$id  = ((isset($_GET['id']) && $_GET['id'] != "null") ? $_GET['id'] : "");	//midlertidig - Bare for å fikse null-verdi fra eScript2
	$pType = (isset($_GET['parentType']) ? $_GET['parentType'] : null);
	
	switch( $_GET['type'] ) {
		case "albumList":
			$this->albumList();
			break;
				
			
		case "pastEvent":
			$query = "SELECT e.id, e.start, e.title 
			FROM event AS e 
			RIGHT JOIN  ".accessId('event',$selfId)." = e.id 
			WHERE start < NOW()
			ORDER BY start $limit";
			$result = mysql_query( $query ) or die(mysql_error());
			while( $row = mysql_fetch_array( $result ) ) {
				echo ("<a href=?site=event&id=$row[id]><div>$row[title]</div><div class='right'>$row[start]</div></a>") .$split;
			}
			break;
			
		case "slideshow":
			$result = query("SELECT imageId, message FROM slide WHERE slideshowId = $id");
			while( $row = mysql_fetch_array( $result ) ) {
				echo ("php/image.php?id=$row[imageId]$split$row[message]$split");
			}			
			break;
	
		case "poll":
			echo ("<table>");
			$query = "SELECT title FROM poll
			RIGHT JOIN  ".accessId('poll',$selfId)." = poll.id 
			WHERE poll.id=$id";
			$result = mysql_query( $query );
			$row = mysql_fetch_array( $result );
			echo ("<tr><th colspan='2'>$row[title]</th></tr>");
			$bool = false;
			if( $_SESSION['logged_in'] ) {
				$query = "SELECT count(*) FROM vote WHERE pollId=$id AND userId=$selfId";
				$result = mysql_query( $query );
				$row = mysql_fetch_array( $result );
				if( !$row[0] ) {
					$bool = true;
				} 
			}
			if( $bool ) {
				$query = "SELECT name, id FROM poll_option WHERE pollId=$id";
				$result = mysql_query( $query );
				echo ("<form action='/php/prosessVote.php?poll_id=$id' method='post'>");
				while( $row = mysql_fetch_array( $result ) ) {
					echo ("<tr><td>$row[name]</td><td><input name='vote' type='radio' value=$row[id] /></td></tr>");
				}
				echo ("<tr><th colspan='2'><input name='submit' type='submit' value='Stem!'></th></tr></form>");
			} else {
				$query = "SELECT a.name, a.color, a.count, FLOOR((a.count / b.total * 100)) AS percentage FROM (SELECT p.name,	p.color,	COALESCE(COUNT(v.choice), 0) AS count FROM poll_option AS p LEFT JOIN vote AS v ON v.choice = p.id AND v.pollId = p.pollId AND v.pollId = $id GROUP BY p.id) AS a, (SELECT COUNT(*) AS total FROM vote AS v WHERE v.pollId = $id) AS b";
				$result = mysql_query( $query );
				while( $row = mysql_fetch_array( $result ) ) {
					echo ("<tr class='topPad'><td>$row[name]</td><td>$row[count]</td></tr>");
					$width = $row['percentage'];
					echo ("<tr><td colspan='2'><div style='background-color: #$row[color]; width:$row[percentage]%;' ><p>$row[percentage]%</p></div></td></tr>");
				}
			}
			echo ("</table>");
			break;
			
		case "calender":
			$firstDay = date("N", mktime(0, 0, 0, $_GET['month'], 0, $_GET['year']));
			$lastDay = date("j", mktime(0, 0, 0, $_GET['month']+1, 0, $_GET['year']));
			$iterate= ($firstDay + $lastDay >= 35 ? 42 : 35) - $firstDay;
		
			$query = "SELECT e.title, e.id, DAY(e.start) day, DATE_FORMAT(e.start, '%k:%i') time 
			FROM event AS e 
			RIGHT JOIN  ".accessId('event',$selfId)." = e.id
			WHERE YEAR(e.start)=$_GET[year] AND MONTH(e.start)=$_GET[month] 
			ORDER BY DAY(e.start)";
			$result = mysql_query( $query ) or die(mysql_error()); 
			
			$row = mysql_fetch_array( $result );

			for( $i = -$firstDay + 1; $i < $iterate; $i++ ) {
				if( $i > 0 && $i <= $lastDay ) {
					if( $i == $row['day'] ) {
						echo ("<a title='$row[title] kl $row[time]' href='?site=event&id=$row[id]'>$i</a>");
						$row = mysql_fetch_array( $result );
					} else {
						echo ($i);
					}
				}
				echo ( $split );
			}
		
			
			
	}


    }
    
}

?>
