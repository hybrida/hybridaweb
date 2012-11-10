<?php

class GalleryModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'gallery.models.*',
			'gallery.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{

		if(parent::beforeControllerAction($controller, $action))
		{
			$this->registerFiles();
			return true;
		}
		else
			return false;
	}

	public function registerFiles()
	{
		$assetDir = "gallery.assets";

		$cssUrl = Yii::getPathOfAlias($assetDir)."/css/";
		$cssFile = "gallery.css";

		$scriptUrl = Yii::getPathOfAlias($assetDir)."/jquery/";
		$keyNavFile = "keyNav.js";

		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cssLocalPath = $am->publish($cssUrl. $cssFile);
		$scriptLocalPath = $am->publish($scriptUrl. $keyNavFile);
		$cs->registerCssFile($cssLocalPath);
		$cs->registerScriptFile($scriptLocalPath);
	}
}
