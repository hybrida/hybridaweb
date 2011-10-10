<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsForm
 *
 * @author sigurd
 */
class NewsForm extends CFormModel {
	
	public $hasNews;
	public $hasSignup;
	public $hasEvent;

	
	public $news;
	
	public $event;
	
	public $signup;

	

	public function __construct($scenario = '') {
		parent::__construct($scenario);
		
		$news = array(
				'title','content','imageId',
		);
		
		$event = array(
				'start','end','location','title',
				'imageId','content',
		);
		
		$signup = array(
				'spots',
				'open',
				'close',
				'signoff',
		);
		
	}
	
	public function rules() {
		return array(
				array('hasNews, hasSignup, hasEvent','boolean'),
				array('news[title],news[content]','required'),
		);
	}	
}

?>
