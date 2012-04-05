<?php

class ImageController extends Controller {

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