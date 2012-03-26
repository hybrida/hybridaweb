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
		if (!array_key_exists($size, ImageProcessor::getSizes())){
			throw new CException("Imagesize \"$size\" does not exists");
		}
		
		$image = Image::model()->findByPk($id);
		if ($image == null) {
			throw new CException("Picture $id.jpg does not exists");
		}
		if (!$image->hasSize($size)) {
			ImageProcessor::resize($image, $size);
		} 
		$this->renderImage($image->getFilePath($size));
	}

}