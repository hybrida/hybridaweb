<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageController
 *
 * @author sigurd
 */
class ImageController extends Controller {

	public $pdo;
	private $bigThumb;
	private $smallThumb;
	private $microThumb;
	private $upcPath;
	private $imagePath;

	private function renderImage($filename) {
		ob_clean();
		header("Content-type: image/jpeg");
		readfile($filename);
	}
	
	public function actionView($id, $size) {
		$image = Image::getResized($id, $size);
		$this->renderImage($image->getFilePath($size));
	}

}