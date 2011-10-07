<?php

MySQL::connect();
	
	$sub = ( isset($_GET['sub']) ? $_GET['sub'] : "0");
	
	//$rbc->setUserImage($id);
	
	if($id== -1){
		echo "<h1> Gjest </h1>";
	} else {
		
		$query = "SELECT ui.firstName, ui.middleName, ui.sirName, u.username, ui.phoneNumber, ui.specialization, ui.graduationYear, ui.imageId, ui.member FROM user u, user_info ui WHERE ui.userId=u.id AND u.id=$id";
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array($result);
		
		echo "<h1> ". $row['firstName'] ." ". $row['middleName'] ." ". $row['sirName'] . " </h1>";
		
		
		echo "<div class='menuPage'>";
		echo "<a href='?site=profile&id=".$id."&sub=0'>Kommentarer</a> ";
		echo "<a href='?site=profile&id=".$id."&sub=1'>Info</a> ";
		echo "<a href='?site=profile&id=".$id."&sub=2'>Annet</a> ";
		echo "</div>";
		
		
		
		
		if( $sub == 0 ) {
			// The Wall FIXME
			//require("content/comments.php");				//Viser kommentarfelt og feed
			
		} else if( $sub == 1 ) {
			echo "<table>";
			echo "<tr><td>Epost: 			</td><td> <a href='mailto:" . $row['username'] . "@stud.ntnu.no' >" . $row['username'] . "@stud.ntnu.no</a></td></tr>\n";
			echo "<tr><td>Hjemmeside:	</td><td><a href='http://folk.ntnu.no/".$row['username']."'>http://folk.ntnu.no/".$row['username']."</a>\n";
			if(isset($row['phoneNumber'])){
				echo "<tr><td>Telefon: 			</td><td> " . $row['phoneNumber'] . "</td></tr>\n";
			}
			echo "<tr><td>Spesialisering: </td><td> " . ( !$row['specialization'] ? " Ingen enda " : "et eller annet" ) . "</td></tr>\n";
			echo "<tr><td>Avgangsår: 		</td><td> " .$row['graduationYear']."</td></tr>\n";
			echo "<tr><td>Medlem: 			</td><td> " . ($row['member'] ? "ja" : "nei") . "</td></tr>\n";
			echo "</table>";
			
		} else if ( $sub == 2 ) {
			//Annet
		}
	}

?>
