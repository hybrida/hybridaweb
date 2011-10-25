<?php
class ImageProcessor  {
    
    public function getFileExtension($src) {
		return substr(strrchr($src,'.'),1);
	}

	public function resizeImage($src, $newWidth, $newHeight) {

		list($oldWidth, $oldHeight) = getimagesize($src);
		if( $oldWidth > $oldHeight ) {
			$realWidth = $newWidth;
			$realHeight = floor( $oldHeight/$oldWidth*$newWidth );
			$y = floor( ($newHeight - $realHeight) / 2 );
			$x = 0;
		} else {
			$realWidth = floor( $oldWidth/$oldHeight*$newHeight );
			$realHeight = $newHeight;
			$x = floor( ($newWidth - $realWidth) / 2 );
			$y = 0;
		}
		
		switch( getFileExtension($src) ){
			case "png":
				$img = ImageCreateFrompng($src);
				break;
			case "jpeg":
				$img = ImageCreateFromjpeg($src);
				break;
			case "jpg":
				$img = ImageCreateFromjpeg($src);
		}
		
		$newImg = ImageCreateTrueColor($newWidth, $newHeight);
		imagecopyresized($newImg, $img, $x, $y, 0, 0, $realWidth, $realHeight, $oldWidth, $oldHeight);
		return $newImg;
	}

	function createThumbnail($src,$x,$y,$dst){
		imagejpeg($this->resizeImage($src, $x, $y), $dst);
	}
}
