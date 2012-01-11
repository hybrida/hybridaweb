<?

Yii::import('application.components.GateKeeper');

class GateKeeperMock extends GateKeeper {

	public function setAccess($access) {
		parent::setAccess($access);
	}

}