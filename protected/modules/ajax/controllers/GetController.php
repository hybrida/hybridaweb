<?php

class GetController extends Controller {

	public function actionGetAccessBlock($sub, $name, $id) {
		$this->widget('application.components.widgets.AccessField', array(
			'name' => $name,
			'id' => $id,
			'sub' => $sub,
			'isAjaxRequest' => true,
		));
	}

	private function searchUsers($search) {

		$limit = (isset($_GET['start']) && isset($_GET['interval'])) ? ' LIMIT ' . $_GET['start'] . ', ' . $_GET['interval'] : ' ';

		if (strlen($_GET['q']) < 1) {
			die("");
		}

		$searchArray = preg_split('/ /', $search);
		$searchString = "";
		$data = array();

		for ($i = 0; $i < count($searchArray); $i++) {
			if ($i > 0)
				$searchString .= " AND";
			$search = $searchArray[$i];
			$searchString .= " (ui.username LIKE :search" . $i . " ui.firstName LIKE :search" . $i . " OR ui.middleName LIKE :search" . $i . " OR ui.lastName LIKE :search" . $i . ")";
			$data['search' . $i] = $search . "%";
		}

		//Søke på brukere
		$sql = "SELECT DISTINCT ui.id AS userId, ui.firstName, ui.middleName, ui.lastName
            FROM user AS ui WHERE " . $searchString;

		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	private function searchNews($search) {

		//Søke på nyheter
		$data = array(
			'type' => 'news',
			'search' => $search
		);

		$sql = "SELECT id, parentId, parentType, title, timestamp
            FROM news n WHERE n.title REGEXP :search
            ORDER BY timestamp DESC";

		$query = $this->pdo->prepare($sql);
		$query->execute($data);
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);

		return $rows;
	}

	public function actionSearch() {

		$split = '~%~';
		$search = $_GET['q'];
		$result['users'] = $this->searchUsers($search);
		$result['newsList'] = $this->searchNews($search);
		$result['url'] = Yii::app()->baseUrl . "/profile/";
		$result['split'] = $split;

		$this->renderPartial('search', $result);
	}

	public function actionAddUserGroupSearch() {
		$split = '~%~';
		$result['users'] = $this->searchUsers();
		$result['split'] = $split;
		$result['url'] = Yii::app()->baseUrl . "/" . $_REQUEST['response'] . "&type=addMember&comission=&userId=";
		$this->renderPartial('search', $result);
	}

	public function actionIndex() {

		$split = "¤¤";
		$split2 = "¤£";


		$limit = (isset($_GET['start']) && isset($_GET['interval'])) ? " LIMIT " . $_GET['start'] . ", " . $_GET['interval'] : "";
		$userId = (isset($_GET['userid']) ? $_GET['userid'] : $selfId);
		$selfId = (($_SESSION['logged_in'] == true) ? $_SESSION['self_id'] : 406);  //406 er besøkende
		$id = ((isset($_GET['id']) && $_GET['id'] != "null") ? $_GET['id'] : ""); //midlertidig - Bare for å fikse null-verdi fra eScript2
		$pType = (isset($_GET['parentType']) ? $_GET['parentType'] : null);

		switch ($_GET['type']) {
			case "albumList":
				$this->albumList();
				break;


			case "pastEvent":
				$query = "SELECT e.id, e.start, e.title
			FROM event AS e
			RIGHT JOIN  " . accessId('event', $selfId) . " = e.id
			WHERE start < NOW()
			ORDER BY start $limit";
				$result = mysql_query($query) or die(mysql_error());
				while ($row = mysql_fetch_array($result)) {
					echo ("<a href=?site=event&id=$row[id]><div>$row[title]</div><div class='right'>$row[start]</div></a>") . $split;
				}
				break;

			case "slideshow":
				$result = query("SELECT imageId, message FROM slide WHERE slideshowId = $id");
				while ($row = mysql_fetch_array($result)) {
					echo ("php/image.php?id=$row[imageId]$split$row[message]$split");
				}
				break;

			case "poll":
				echo ("<table>");
				$query = "SELECT title FROM poll
			RIGHT JOIN  " . accessId('poll', $selfId) . " = poll.id
			WHERE poll.id=$id";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				echo ("<tr><th colspan='2'>$row[title]</th></tr>");
				$bool = false;
				if ($_SESSION['logged_in']) {
					$query = "SELECT count(*) FROM vote WHERE pollId=$id AND userId=$selfId";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result);
					if (!$row[0]) {
						$bool = true;
					}
				}
				if ($bool) {
					$query = "SELECT name, id FROM poll_option WHERE pollId=$id";
					$result = mysql_query($query);
					echo ("<form action='/php/prosessVote.php?poll_id=$id' method='post'>");
					while ($row = mysql_fetch_array($result)) {
						echo ("<tr><td>$row[name]</td><td><input name='vote' type='radio' value=$row[id] /></td></tr>");
					}
					echo ("<tr><th colspan='2'><input name='submit' type='submit' value='Stem!'></th></tr></form>");
				} else {
					$query = "SELECT a.name, a.color, a.count, FLOOR((a.count / b.total * 100)) AS percentage FROM (SELECT p.name,	p.color,	COALESCE(COUNT(v.choice), 0) AS count FROM poll_option AS p LEFT JOIN vote AS v ON v.choice = p.id AND v.pollId = p.pollId AND v.pollId = $id GROUP BY p.id) AS a, (SELECT COUNT(*) AS total FROM vote AS v WHERE v.pollId = $id) AS b";
					$result = mysql_query($query);
					while ($row = mysql_fetch_array($result)) {
						echo ("<tr class='topPad'><td>$row[name]</td><td>$row[count]</td></tr>");
						$width = $row['percentage'];
						echo ("<tr><td colspan='2'><div style='background-color: #$row[color]; width:$row[percentage]%;' ><p>$row[percentage]%</p></div></td></tr>");
					}
				}
				echo ("</table>");
				break;
		}
	}

	public function actionUserSearch($usernameStartsWith) {
		$username = $usernameStartsWith;
		$username = preg_replace("/[^a-zA-Z]*/", "", $username);
		$term = "'" . $username . "%'";
		$sql = sprintf(
				'username LIKE %s OR firstName LIKE %s OR lastName LIKE %s',
				$term, $term, $term);
		$users = User::model()->findAll($sql);
		echo CJSON::encode($users);
	}

}