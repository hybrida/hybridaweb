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
    
    public function actionIndex() {
	
	$split = "¤¤";
	$split2 = "¤£";
	
	
	$limit  = (isset($_GET['start']) && isset($_GET['interval']))  ? " LIMIT " . $_GET['start'] . ", " . $_GET['interval'] : "";
	$userId = clean(isset($_GET['userid']) ? $_GET['userid'] : $selfId);
	$selfId = (($_SESSION['logged_in']==true) ? $_SESSION['self_id'] : $guest);		//406 er besøkende
	$id  = clean((isset($_GET['id']) && $_GET['id'] != "null") ? $_GET['id'] : "");	//midlertidig - Bare for å fikse null-verdi fra eScript2
	$pType = clean(isset($_GET['parentType']) ? $_GET['parentType'] : null);
	
	switch( $_GET['type'] ) {
		case "albumList":
			$this->albumList();
			break;
	
		case "signup":
			echo ("<dropdown data-title='påmeldte'>");
			$query = "SELECT ui.userId, ui.firstName, ui.middleName, ui.sirName 
			FROM membership_signup AS ms LEFT JOIN user_info AS ui ON ms.userId = ui.userId LEFT JOIN event as e ON e.id=ms.eventId
			RIGHT JOIN  ".accessId('event',$selfId)." = e.id
			WHERE ms.signedOff='false' AND ms.eventId=$id ORDER BY ui.graduationYear";
			$result = mysql_query( $query ) or die(mysql_error());
			$signType = "on";
			$buttonText = "Meld meg på";
			echo "<ul>";
			while( $row = mysql_fetch_array( $result ) ) {
				echo ("<li><a href='?site=profile&id=$row[userId]'>$row[firstName] $row[middleName] $row[sirName]</a></li>");
				if( $row['userId'] == $userId ) {
					$signType = "off";
					$buttonText = "Meld meg av";
				}
			}
			echo ("</ul></dropdown>");
			/*$query = "SELECT EXISTS(signoff=='true' AND NOW() BETWEEN open AND close) AS signup FROM signup WHERE  AND eventId=$_GET[id]";
			$result = mysql_query( $query );
			$row = mysql_fetch_array( $result );*/
			if( !($signType=="off" && $row['signoff'] == "false") ) echo ("<form data-event_id='$id' data-sign_type='$signType'><input name='submit' type='submit' value='$buttonText' /></form>");
			break;
			
		case "event":
			$query = "SELECT e.id, e.start, e.title 
			FROM event AS e 
			RIGHT JOIN  ".accessId('event',$selfId)." = e.id 
			WHERE start >= NOW()
			ORDER BY start $limit";
			$result = mysql_query( $query ) or die(mysql_error());
			while( $row = mysql_fetch_array( $result ) ) {
				echo ("<a href=?site=event&id=$row[id]><div>$row[title]</div><div class='right'>$row[start]</div></a>") .$split;
			}
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
			
	
		case "comment":
			$pId = (($id==null) ? $selfId : $id);						//Hvis ikke profilid angitt, vis egen profil
			$pType = $_GET['parentType'];
			
			function comment($pType,$pId,$selfId,$split) {
				$query = "SELECT u.imageId, c.id, c.content, c.timestamp, u.firstName, u.middleName, u.sirName 
				FROM comment AS c JOIN user_info AS u ON c.author = u.userId
				RIGHT JOIN ".accessId('comment',$selfId)." = c.id
				WHERE c.parentType = '$pType' AND c.parentId = $id 
				ORDER BY c.timestamp DESC $limit";
				//echo $query . "<p><br></p>";
				$result = mysql_query( $query ) or die(mysql_error());
				while( $row = mysql_fetch_array( $result ) ) {
					$image = ($row['path'] ? $row['path'] : "images/user/unknown.jpg");
					$content = $row['content'];
					echo "<img src='php/image.php?id=$row[imageId]&size=2' />";
					echo $content;
					echo "<div class='author'><i>skrevet av: $row[firstName] $row[middleName] $row[sirName] den: $row[timestamp]</i></div>";
					comment('comment',$row['id'],$selfId,'¤£');		//Print 2.nivåkommentarer
					echo $split;
				}
			}
			comment($pType,$pId,$selfId,$split);	//Print kommentarer
			break;
			
			

		case 'news':
				
			//Feil å bruke parentType for selection. 
			if ( $pType == "newsfeed" ) {			
				$query = "SELECT DISTINCT ui.userId AS userId, n.id AS id,parentId, parentType, n.title, n.imageId AS imageId, content, firstName, middleName, sirName, timestamp 
							FROM news n JOIN user_info ui ON n.author = ui.userId 
							RIGHT JOIN ".accessId('news',$selfId)." = n.id 
							ORDER BY timestamp DESC $limit";
			}
			else {
				$query = "SELECT DISTINCT ui.userId AS userId, n.id AS id,parentId, parentType, n.title, n.imageId AS imageId, content, firstName, middleName, sirName, timestamp FROM news n
							RIGHT JOIN (SELECT ar.id AS accessId, ma.userId FROM membership_access ma LEFT JOIN access_relations ar ON ma.accessId=ar.access WHERE ar.type='news' AND ma.userId = 327) AS a ON a.accessId = n.id 
							RIGHT JOIN news_tags AS nt ON nt.newsId = n.id 
							LEFT JOIN groups AS g ON g.id = nt.ownerId 
							LEFT JOIN user_info ui ON n.author = ui.userId
							WHERE g.id = ".$id;
			}
			//echo $query;
			
			$result = mysql_query( $query ) or die(mysql_error());
			//echo "numRows:" . mysql_num_rows($result) . "";
			while( $row = mysql_fetch_array( $result ) ) {
				
				echo "<div class='contentItem'>";
				echo "	<div class='blueBox'>";
				echo "		<div class='blueBoxItem'>";
				echo "		</div>";
				echo "	</div>\n";
					
				echo "	<div class='topBar'>";
				echo "		<div class='topBarItem'>";
				echo "		</div>";
				
				//Printer overskrift som link hvis event eller lenger nyhet
				if($row['parentType']==NULL) { // FIX parentType -> 'parentType'
					$parentType = "news";
					$parentId = $row['id'];
					echo "<h1>".$row['title']."</h1>";
				} else {
					$parentType = $row['parentType'];
					$parentId = $row['parentId'];
					echo "<a href='?site=$parentType&id=$row[parentId]'><h1>$row[title]</h1></a>";
				} 
				
				echo "	</div>";
				echo "	<div class='articleContent'>";
				
				//Hvis nyheten har bilde
				if ( $row['imageId']!=null) { // FIX imageId -> 'imageId'
					echo "<img src='php/image.php?id=".$row['imageId']."&size=2' />"; // FIX imageId -> 'imageId'
				}
				echo	"<p>";
				
				//Hvis nyheten er for lang hvis en les mer link
				if (strlen($row['content'])>$contentLength) {
					echo ( substr($row['content'],0,$contentLength));
					echo ("... ");
					
					
					echo ("<a href='?site=$parentType&id=$parentId'>Les mer</a>");
				} else {
					echo ( $row['content']);
				}
				echo "</p>";
				
				//Printer dato og forfatter
				echo "<div class='date'>".$row['timestamp']."</div>";
				echo ("<div class='author'>skrevet av: <a href='?site=profile&id=".$row['userId']."'> $row[firstName] $row[middleName] $row[sirName] </a></div>"); // FIX userId -> 'userId'
				echo ("</div>");
				//echo ( $split );
			}
			break;
		
		case "all":
			$searchArray = preg_split( '/ /', $_GET['q'] );
			$searchString = "";
			for( $i = 0; $i < count( $searchArray ); $i++ ) {
				if( $i > 0 ) $searchString .= " AND";
				$search = clean($searchArray[$i]);
				$searchString .= " (firstName LIKE '$search%' OR middleName LIKE '$search%' OR sirName LIKE '$search%')";
			}
			//Søke på brukere
			$query = "SELECT DISTINCT ui.userId, ui.firstName, ui.middleName, ui.sirName 
			FROM user_info AS ui,membership_access AS ma WHERE ma.accessId != 0 AND ma.userId=$selfId AND $searchString $limit";
			$result = mysql_query( $query ) or die(mysql_error());
			while( $row = mysql_fetch_array( $result ) ) {
				echo ("<a href='?site=profile&id=" . $row['userId'] . "'>" . $row['firstName'] . " " . $row['middleName'] . " " . $row['sirName'] . "</a>");
				echo ( $split );
			}
			//Søke på nyheter
			$query = "SELECT id, parentId, parentType, title, timestamp 
			FROM news n 
			RIGHT JOIN ".accessId('news',$selfId)." = n.id 
			WHERE n.title REGEXP '$search'
			ORDER BY timestamp DESC $limit";
			$result = mysql_query( $query ) or die(mysql_error());
			while( $row = mysql_fetch_array( $result ) ) {
				if($row[parentType]==NULL) {
					$parentType = "news";
					echo ("<a title='$row[title] $row[timestamp]' href='?site=$parentType&id=$row[parentId]'>$row[title]</a>");
				} else {
					$parentType = $row['parentType'];
					echo ("<a title='$row[title], Dato: $row[timestamp]' href='?site=$parentType&id=$row[parentId]'>$row[title]</a>");
				} 
			}
			
			echo ("<a href='#'><i>Avansert søk</i></a>");
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
