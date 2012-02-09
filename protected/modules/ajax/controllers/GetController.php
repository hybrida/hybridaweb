<?php

class GetController extends Controller{
    //put your code here
    private $split = "~%~";
	
	public function actionGetAccessBlock($sub, $name, $id) {
		$this->widget('application.components.widgets.AccessField', array(
			'name' => $name,
			'id' => $id,
			'sub' => $sub,
			'isAjaxRequest' => true,
		));
	}
    
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
    
    public function actionEventfeed(){
        $limit  = (isset($_GET['s']) && isset($_GET['l']))  ? ' LIMIT ' . ( $_GET['s'] ) . ', ' .( $_GET['s'] + 4) : '';
       
        $data = array(
            'userId' => Yii::app()->user->id,  
        );
        
        $sql = "SELECT e.id, e.title, e.start FROM 
                event AS e RIGHT JOIN membership_signup AS ms 
                ON ms.eventId= e.id 
                WHERE ms.userId = :userId AND signedOff = 'false' AND start > NOW()
                ORDER BY start DESC " . $limit;
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        $data['events'] = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $this->renderPartial('eventfeed', $data);
        
    }
    
	
	//Brukes denne? Ikke noe TILGANGSKONTROLL
    public function actionFeed(){
        $contentLength = 500;
        $limit  = (isset($_GET['s']) && isset($_GET['l']))  ? ' LIMIT ' . $_GET['s'] . ', ' . $_GET['l'] : ' ';
        

        if ( !isset($_GET['parentType'])) {			
            $sql = "SELECT DISTINCT ui.id AS userId, n.id AS id,parentId, parentType, n.title, n.imageId AS imageId, content, firstName, middleName, lastName, timestamp 
                        FROM news n JOIN hyb_user ui ON n.author = ui.id 
                        ORDER BY timestamp DESC " . $limit;
            
            $data = array(
                'userId' => Yii::app()->user->id,
                'type' => 'news'
                    
        );
        }
        else {
            $sql = "SELECT DISTINCT ui.id AS userId, n.id AS id,parentId, parentType, n.title, n.imageId AS imageId, content, firstName, middleName, lastName, timestamp FROM news n
                        RIGHT JOIN (SELECT ar.id AS accessId, ma.userId FROM membership_access ma LEFT JOIN access_relations ar ON ma.accessId=ar.access WHERE ar.type='news' AND ma.userId = 327) AS a ON a.accessId = n.id 
                        RIGHT JOIN tag AS t ON t.id = n.id 
                        LEFT JOIN groups AS g ON g.id = t.ownerId 
                        LEFT JOIN hyb_user ui ON n.author = ui.id
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
			if( !isset($_REQUEST['post']) ) {
                $pId = $_REQUEST['id'];
                $pType = $_REQUEST['type'];

                $data['id'] = $pId;
                $data['html'] = $this->comment($pType,$pId,$split);
                $this->renderPartial('comment',$data);
            } else {               
                //Noe feil her
                //echo $_REQUEST['data-content'];
                
            }
                
            
    }
    
    //List nested comments
    private function comment($pType,$pId,$split) {
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'type' => 'comment',
            'id' => $pId,
            'pType' => $pType
        );

        $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';

        $sql = "SELECT u.imageId, c.id, c.content, c.timestamp, u.firstName, u.middleName, u.lastName 
        FROM comment AS c JOIN hyb_user AS u ON c.author = u.id
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
            'type' => 'event'
        );
          
        $sql = "SELECT e.id AS id, e.start AS start, e.title AS title
        FROM event AS e 
        WHERE start >= NOW()
        ORDER BY start $limit";
         
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        
    
        $data['events'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['split'] = $split;
        
        $this->renderPartial('event',$data);
    }
    
    public function actionSignup($id){
        
        $eId = $_REQUEST['id'];
        
		/*ob_end_clean();
        header("Connection: close\r\n");
        header("Content-Encoding: none\r\n");
        ignore_user_abort(true);
        ob_start();
		*/
        
        if(app()->gatekeeper->hasPostAccess('event', $eId)){
            
			$data = array(
				'eId' => $eId,
			);
			
			$sql = "SELECT e.bpcID, s.open, s.close, s.spots - ms.count AS available FROM signup AS s LEFT JOIN 
				(SELECT eventId AS id, COUNT(*) AS count FROM membership_signup GROUP BY eventId) AS ms
				ON s.eventId = ms.id 
				JOIN event AS e ON e.id = s.eventId
				WHERE s.eventId = :eId";
			$query = $this->pdo->prepare($sql);
			$query->execute($data);
			
			$event = $query->fetch(PDO::FETCH_ASSOC);
			

			
		
            //Hvis brukeren prøver å poste, legg til først for så å oppdatere
            if(isset($_REQUEST['type'])) {               
                $signedOff = $_REQUEST['type'] == "on" ? "false" : "true";

				//Gjøres sikkert i BPC etterhvert..
				if (time() < strtotime($event['open']) || time() > strtotime($event['close']) ) {
					die("Påmelding ikke åpen, eller ikke ledige plasser!");	//Påmelding ikke åpen, eller ikke ledige plasser!
				}
				
                $data = array(
                    'id' => $eId,
                    'selfId' => Yii::app()->user->id,
                    'signupId' => $signedOff
                );
                $sql = "INSERT INTO membership_signup VALUES( :id, :selfId, :signupId ) ON DUPLICATE KEY UPDATE signedOff = :signupId";
                $query = $this->pdo->prepare($sql);
                $query->execute($data);
				Yii::import('bpc.components.*');
				BpcCore::removeAttending($event['bpcID'], user()->id);
            }
            
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == "on") {
                $facebook = true;
            }
            
            $split = '~%~';
            $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';

            $input = array(
                'id' => $eId
            );
            
            $sql = "SELECT ui.id AS userId, ui.firstName, ui.middleName, ui.lastName, ui.imageId 
            FROM membership_signup AS ms LEFT JOIN hyb_user AS ui ON ms.userId = ui.id LEFT JOIN event as e ON e.id=ms.eventId
            WHERE ms.signedOff='false' AND ms.eventId=:id ORDER BY ui.graduationYear";

            $query = $this->pdo->prepare($sql);
            $query->execute($input);

            $data['list'] = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['id'] = $id;

            $input = array(
                'id' => $eId,
                'userId' => Yii::app()->user->id
            );
            $sql = "SELECT userId, signedOff FROM membership_signup WHERE eventId = :id AND userId = :userId";
            $query = $this->pdo->prepare($sql);
            $query->execute($input);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result['userId'] == Yii::app()->user->id && $result['signedOff']=="false"){
                $data['signType'] = "off";
                $data['buttonText'] = "Meld meg av";
            }
            else
            {
                $data['signType'] = "on";
                $data['buttonText'] = "Meld meg på";
            }

            $this->renderPartial('signup',$data);
        
            /* $size = ob_get_length();
            header("Content-Length: " . $size);
            ob_end_flush();
            flush();
            ob_end_clean(); */

            if(isset($facebook)){
                $fb = new Facebook();
                $fb->setAttending($eId);                
            }
        }else{
            $this->renderPartial('../site/403');
        }
    }
    
    public function actionGroup(){
        $gId = $_REQUEST['gId'];
        $type = $_REQUEST['type'];
        
        
        $group = new Group($gId);
        if($group->isAdmin( Yii::app()->user->id )){
            if ($type == 'delMember'){
                $group->removeMember( $_REQUEST['userId'] );
            }
            if($type == 'addMember'){
                $comission = (isset($_REQUEST['commission'])) ? $_REQUEST['commission'] : "Member";
                $group->addMember( $_REQUEST['userId'] , $comission );
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
    
    private function searchUsers($search){
            
            $limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';
            
            if(strlen($_GET['q']) < 1) {
                die("");
            }
            
            $searchArray = preg_split( '/ /', $search );
            $searchString = "";
            $data = array();
            
            for( $i = 0; $i < count( $searchArray ); $i++ ) {
                if( $i > 0 ) $searchString .= " AND";
                $search = $searchArray[$i];
                $searchString .= " (ui.username LIKE :search" . $i . " ui.firstName LIKE :search".$i." OR ui.middleName LIKE :search".$i." OR ui.lastName LIKE :search".$i.")";
                $data['search' . $i] = $search . "%";
            }
            
            //Søke på brukere
            $sql = "SELECT DISTINCT ui.id AS userId, ui.firstName, ui.middleName, ui.lastName 
            FROM hyb_user AS ui WHERE " . $searchString;
            
            $query = $this->pdo->prepare($sql);
            $query->execute($data);
            
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    private function searchNews($search){
   
            //Søke på nyheter
            $data = array(
                'type'   => 'news',
                'search' => $search
            );
            
            $sql = "SELECT id, parentId, parentType, title, timestamp 
            FROM news n WHERE n.title REGEXP :search
            ORDER BY timestamp DESC";
            
            $query = $this->pdo->prepare($sql);
            $query->execute($data);
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            
            /*$i = 0;
            $returnArray = Array();
            foreach ($rows as $row){
                
                if(app()->gatekeeper->hasPostAccess('news', $row['id'])){
                    $returnArray[i++] = $row['id'];
                }
            }*/
            
            return $rows;
            
            
    }
    
    public function actionSearch(){
        
        $split = '~%~';
        $search = $_GET['q'];
        $result['users'] = $this->searchUsers($search);
        $result['newsList'] = $this->searchNews($search);
        $result['url'] = Yii::app()->baseUrl . "/profile/";
        $result['split'] = $split;
        
        $this->renderPartial('search',$result);
        
    }
    
    public function actionAddUserGroupSearch(){
        $split = '~%~';
        $result['users'] = $this->searchUsers();
        $result['split'] = $split;
        $result['url'] = Yii::app()->baseUrl . "/" . $_REQUEST['response'] . "&type=addMember&comission=&userId=" ;
        $this->renderPartial('search',$result);
    }

    
    
    public function actionCalendar(){
        $firstDay = date("N", mktime(0, 0, 0, $_GET['month'], 0, $_GET['year']));
        $lastDay = date("j", mktime(0, 0, 0, $_GET['month']+1, 0, $_GET['year']));
        $iterate= ($firstDay + $lastDay >= 35 ? 42 : 35) - $firstDay;

        $data = array(
            'year' => $_GET['year'],
            'month' => $_GET['month']
        );

        $sql = "SELECT n.id ,n.title , DAY(e.start) AS day, DATE_FORMAT(e.start, '%k:%i') AS time 
        FROM event AS e 
		JOIN news AS n ON n.parentId = e.id
        WHERE YEAR(e.start) = :year 
			AND MONTH(e.start) = :month
			AND n.parentType = 'event'
        ORDER BY DAY(e.start)";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        for( $i = -$firstDay + 1; $i < $iterate; $i++ ) {
            if( $i > 0 && $i <= $lastDay ) {
                if( $i == $result['day'] ) {
                    echo ("<a title='" . $result['title'] . " kl " . $result['time'] . "' href='" . Yii::app()->request->baseUrl ."/news/" . $result['id'] ."/" . $result['title'] . "'>" . $i . "</a>");
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    //$row = mysql_fetch_array( $result );
                } else {
                    echo ($i);
                }
            }
            echo ( $this->split );
        }
    }
    
    public function actionFileUpload(){

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
			
    	}
    }
}