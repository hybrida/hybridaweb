<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupMenu
 *
 * @author sigurd
 */
class GroupMenu extends CWidget {
	public $model;
	public $data;
	
	
	public function init() {
		$this->data = array();
		
		$subs = $this->model->getMenu();
		$this->data['subs'] = $subs;
		
	}
	
	public function run() {
		$this->render("groupMenu",  $this->data);
	}
	
}