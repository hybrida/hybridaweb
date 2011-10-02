<?php

class Event extends Edit {

	function __construct() {
		parent::__construct();
		$this->fields = array(
			'id' => null,
			'start' => null,
			'end' => null,
			'location' => null,
			'title' => null,
			'imageId' => null,
			'content' => null
		);

		$this->updateFilter = array('id');
		$this->setFilter = array('id');
		$this->pushFilter = array();

		$this->newsId = null;

		$this->tableName = "event";
	}

	function hasSignup() {
		$sql = "SELECT eventId, active FROM signup WHERE eventId = " . $this->fields['id'];
		$result = $this->con->query($sql, __FILE__ . ", " . __FUNCTION__) ;
		if ($result)
			if ($row = $this->con->fetch($result)) {
				return true;
			}
		return false;
	}

	function getSignup() {
		if ($this->hasSignup()) {
			$signup = new Signup();
			$signup->fetch($this->fields['id']);
			return $signup;
		}
		return null;
	}

	function getNews() {
		if ($this->getId() == null) {
			$this->err->error("Kunne ikke hente News");
			return null;
		}
		$sql = <<<EOF
SELECT id
	FROM news
	WHERE news.parentId ={$this->fields['id']}
	AND news.parentType = 'event';
EOF;

		$query = $this->con->query($sql, "henter tilhørende news-id for en event");
		$result = $this->con->fetch($query);
		$id = $result['id'];

		if ($id == null) {
			return null;
		}
		$news = new News($id);
		return $news;
	}

}

?>
