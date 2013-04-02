<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

	/**
	 * @var string the default layout for the controller view
	 */
	public $layout = '//layouts/singleColumn';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 * Does only work if the layout is set to //layouts/crud.
	 */
	public $menu = array();

	public $breadcrumbs = array();
	public $breadcrumbOptions = array();
	public $pdo;
	private $jsFiles = array();

	public function __construct($id, $module=null) {
		parent::__construct($id, $module);
		$this->pdo = Yii::app()->db->getPdoInstance();
	}

}