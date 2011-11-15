<?php

/**
 * Description of DebugController
 *
 * @author sigurd
 */
class DebugController extends Controller {
	
	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
		
		echo "<pre>";
		
	}
	
	public function actionActiveRecord() {
		$news = News::model();
		$news = $news->findByPk(2);
		#$news = $news->findByPk(223);
		
		print_r($news->attributes);
		
	}
}

?>
