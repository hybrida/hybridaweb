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
			$this->registerCss();
			return true;
		}
		else
			return false;
	}

	public function registerCss()
	{
		$assetDir = "gallery.assets";
		$url = Yii::getPathOfAlias($assetDir)."/css/";
		$cssFile = "gallery.css";


		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$localPath = $am->publish($url. $cssFile);
		$cs->registerCssFile($localPath);
	}
}
