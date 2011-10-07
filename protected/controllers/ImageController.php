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

	private $bigThumb;
	private $smallThumb;
	private $microThumb;
	private $upcPath;
	private $imagePath;

	public function __construct() {
		//header("Content-type: image/jpeg"); 
		MySQL::connect(); //FIXME
		$this->upcPath = dirname(dirname(dirname(__FILE__))) . "/" . "upc/";
		$this->imagePath = dirname(dirname(dirname(__FILE__))) . "/" . "images/";
	}

	public function actionIndex() {
		$file = $this->imagePath . "unknown_malefemale_profile.jpg";
		header ('Content-length: ' .filesize($file));
		header ('Content-type: image/jpeg');
		readfile($file);
	}

	public function actionView($id, $size) {

		$imageId = $id;
		//$access = "access IN (" . implode(",", $_SESSION['access']) . ")";

		if (preg_match("/^([0-9]*)$/", $imageId)) {
			//$result = mysql_query("SELECT * FROM view_getImage WHERE id=$imageId AND $access");
			$query = "SELECT  u.username 
						FROM image AS i LEFT JOIN user AS u ON i.userId=u.id" .
							//"RIGHT JOIN " . Access::innerSQLAllowedTypeIds('image',Yii::app()->user->id  ) . " = i.id".
							"WHERE i.id = " . $imageId;

			$result = mysql_query($query);

			$row = mysql_fetch_array($result);

			if (mysql_num_rows($result) > 0) {
				$dir = "$this->upcPath$row[0]/images/$imageId.jpg";
				switch ($_GET["size"]) {
					case 1:
						if (!file_exists("$this->upcPathbigthumb/$imageId.jpg")) {
							require("processImage.php");
							createThumbnail("$dir", $bigThumb['width'], $bigThumb['height'], "$this->upcPathbigthumb/$imageId.jpg");
						}
						readfile("$this->upcPathbigthumb/$imageId.jpg");
						break;

					case 2:
						if (!file_exists("$this->upcPathsmallthumb/$imageId.jpg")) {
							require("processImage.php");
							createThumbnail("$dir", $smallThumb['width'], $smallThumb['height'], "$this->upcPathsmallthumb/$imageId.jpg");
						}
						readfile("$this->upcPathsmallthumb/$imageId.jpg");
						break;
					case 3:
						if (!file_exists("$this->upcPathmicrothumb/$imageId.jpg")) {
							require("processImage.php");
							createThumbnail("$dir", $microThumb['width'], $microThumb['height'], "$this->upcPathmicrothumb/$imageId.jpg");
						}
						readfile("$this->upcPathmicrothumb/$imageId.jpg");
						break;
					default:
						readfile($dir);
				}
			} else {
				$this->unknown($size);
			}
		} else {
			$this->unknown($size);
		}
	}

	public function unknown($size) {
		switch ($size) {
			case 1:
				readfile($this->imagePath . "unknown_malefemale_profile.jpg");
			case 2:
				//readfile($this->imagePath."unknown_malefemale_profile_small.jpg");
				break;
			case 3:
				readfile($this->imagePath . "unknown_malefemale_profile_micro.jpg");
				break;
		}
	}

}
?>


<?php

$bigThumb = array("width" => 240, "height" => 180);
$smallThumb = array("width" => 100, "height" => 75);
$microThumb = array("width" => 40, "height" => 40);
?>