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

		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cssLocalPath = $am->publish($cssUrl. $cssFile);
		$cs->registerCssFile($cssLocalPath);

		$scriptUrl = Yii::getPathOfAlias("gallery.assets").'/jquery/';
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();

		foreach(array("keyNav.js", "imageView.js") as $scriptFile) {
			$scriptLocalPath = $am->publish($scriptUrl. $scriptFile);
			$cs->registerScriptFile($scriptLocalPath, CClientScript::POS_END);
		}
	}
}
