<?php

class KiltModule extends CWebModule
{
	private $groupId = 57;
	private $cssDir = "kilt.css";

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'kilt.models.*',
			'kilt.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$this->initAssets();
			 if(Yii::app()->user->isGuest)
				throw new CHttpException(403, "Du har ikke tilgang");
			return true;
		}
		else
			return false;
	}

	private function initAssets() {
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$path = Yii::getPathOfAlias($this->cssDir);
		$css = $path . "/shop.css";

		$cs->registerCssFile($am->publish($css));
	}
}
