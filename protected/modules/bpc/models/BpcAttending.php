<?php

class BpcAttending extends CComponent {

	private $usernames = array();
	private $activeRecordUsers = array();

	public function __construct($id) {
		$this->doRequest($id);
	}

	private function doRequest($id) {
		$postdata = array(
			'request' => $this->getRequest(),
			'event' => $id,
		);
		$request = BpcCore::doRequest($postdata);
		$this->addUsernames($request);
	}
	
	protected function getRequest() {
		return 'get_attending';
	}

	private function addUsernames($request) {
		if (!isset($request['users'])) {
			return;
		}
		foreach ($request['users'] as $userAttend) {
			$this->usernames[] = $userAttend['username'];
		}
	}

	public function getUsernames() {
		return $this->usernames;
	}

	public function getActiveRecords() {
		if ($this->activeRecordUsers == null) {
			$this->addActiveRecordUsers();
		}
		return $this->activeRecordUsers;
	}

	private function addActiveRecordUsers() {
		$this->activeRecordUsers = array();
		foreach ($this->usernames as $username) {
			$user = User::model()->find('username = ?', array($username));
			if ($user) {
				$this->activeRecordUsers[] = $user;
			}
		}
	}
	
	public function contains($username) {
		return in_array($username, $this->usernames);
	}


}