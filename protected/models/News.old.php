<?php

/**
 * Alters a news-post in the database
 */
class News extends Edit {

	private $event = null;

	function __construct() {
		parent::__construct();
		$this->fields = array(
				'id' => null,
				'title' => null,
				'parentId' => null,
				'parentType' => null,
				'imageId' => null,
				'content' => null,
				'author' => null,
				'timestamp' => null,
		);

		$this->updateFilter = array('id', 'author', 'timestamp');
		$this->pushFilter = array();
		$this->setFilter = array('id', 'author', 'timestamp');

		$this->tableName = "news";
	}

	public function push() {
		$this->fields['timestamp'] = date('Y-m-d H:i:s');
		$this->fields['author'] = $_SESSION['self_id'];
		parent::push();
	}

	/**
	 * Returns this news' event if it exists.
	 *
	 * @return Event
	 * @return null
	 */
	function getEvent() {
		if ($this->hasEvent()) {
			if ($this->fields['parentType'] == 'event') {
				$this->event = new Event();
				$this->event->fetch($this->fields['parentId']);
			}
		}
		return $this->event;
	}

	/**
	 * Returns true if it has an event
	 * @return boolean
	 */
	public function hasEvent() {
		return ($this->fields['parentType'] == 'event');
	}

	/**
	 * Edits this news-object's event to $event
	 * @param Event $event
	 */
	function appendEvent(&$event) {
		$this->event = $event;
		$this->fields['parentId'] = $this->event->getId();
		$this->fields['parentType'] = 'event';
		$this->err->message("news->AppendEvent success");
	}

	function removeEvent() {
		$this->event = null;
		$this->fields['parentType'] = "";
		$this->fields['parentId'] = "";
	}

}

// date( 'Y-m-d H:i:s');
