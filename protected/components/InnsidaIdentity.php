<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class InnsidaIdentity extends CUserIdentity {

    protected $_id;
    protected $_userName;
    protected $_access;
    protected $sso;
    protected $user;

    public function __construct($ssoClient) {
        parent::__construct(null, null);
        $this->sso = $ssoClient;
        $this->_userName = $this->sso->loginvalues['username'];
        $this->initUserModel();
        if (!$this->userExists()) {
            return;
        }
        $this->initStates();
        $this->_id = $this->user->id;
    }

    public function authenticate() {
        if ($this->sso->oklogin() && $this->userExists()) {
            $this->updateLastLogin();
            return true;
        }
        return false;
    }
    
    private function updateLastLogin() {
        $this->user->lastLogin = new CDbExpression('NOW()');
        $this->user->save();
    }

    private function initStates() {
        $this->initUserStates();
        $this->setState("access", $this->user->access);
        return true;
    }

    private function initUserModel() {
        $user = User::model()->find(
                "username = :username", array(":username" => $this->_userName)
        );
        $this->user = $user;
    }

    private function initUserStates() {
        $info = $this->user->getAttributes();
        $this->setState("firstName", $info['firstName']);
        $this->setState("middleName", $info['middleName']);
        $this->setState("lastName", $info['lastName']);
        $this->setState("member", $info['member']);
        $this->setState("gender", $info['gender']);
        $this->setState("imageId", $info['imageId']);
    }

    public function getErrorMessage() {
        return $this->sso->reason();
    }

    public function getName() {
        return $this->_userName;
    }

    public function getId() {
        return $this->_id;
    }

    private function userExists() {
        return $this->user != null;
    }

}