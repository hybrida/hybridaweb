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

	public function __construct() {
		$this->layout = '';
        
        header("Content-type: image/jpeg"); 
        $this->pdo = Yii::app()->db->getPdoInstance();
        
		$this->upcPath = dirname(dirname(dirname(__FILE__))) . "/" . "upc/";
		$this->imagePath = dirname(dirname(dirname(__FILE__))) . "/" . "images/";
        
        	
        $this->bigThumb = array("width" => 240, "height" => 180);
        $this->smallThumb = array("width" => 100, "height" => 75);
        $this->microThumb = array("width" => 40, "height"=> 40);
	}

	public function actionIndex() {
		$file = $this->imagePath . "unknown_malefemale_profile.jpg";
		//header ('Content-length: ' .filesize($file));
		//header ('Content-type: image/jpeg');
        readile($file);
	}

	public function actionView($id, $size) {

		$imageId = $id;
		//$access = "access IN (" . implode(",", $_SESSION['access']) . ")";

		if (preg_match("/^([0-9]*)$/", $imageId)) {
			//$result = mysql_query("SELECT * FROM view_getImage WHERE id=$imageId AND $access
            $data = array(
                //'userId' => Yii::app()->user->id,
                //'type'  => 'image',
                'imageId' => $imageId
                
            );
			$sql = "SELECT  u.username 
                    FROM image AS i LEFT JOIN user AS u ON i.userId = u.id 
                    WHERE i.id = :imageId";
            //"RIGHT JOIN " . Access::innerSQLAllowedTypeIds('image',Yii::app()->user->id  ) . " = i.id".

            $query = $this->pdo->prepare($sql);
            $query->execute($data);
            
			$row = $query->fetch(PDO::FETCH_ASSOC);

			if ($query->rowCount() > 0) {
				$dir = $this->upcPath . $imageId.".jpg";
				switch ($_GET["size"]) {
					case 1:
						if (!file_exists($this->upcPath . "microthumb/" . $imageId . ".jpg")) {
							$process = new ImageProcessor();
							$process->createThumbnail("$dir", $this->bigThumb['width'], $this->bigThumb['height'], $this->upcPath ."/bigthumb" . $imageId . ".jpg");
						}
						readFile($this->upcPath . "bigthumb/" . $imageId .".jpg");
						break;

					case 2:
						if (!file_exists($this->upcPath . "smallthumb/" . $imageId . ".jpg")) {
							$process = new ImageProcessor();
							$process->createThumbnail($dir, $this->smallThumb['width'], $this->smallThumb['height'], $this->upcPath ."smallthumb/".$imageId.".jpg");
						}
						readFile($this->upcPath . "smallthumb/" . $imageId.".jpg");
						break;
					case 3:
						if (!file_exists($this->upcPath . "microthumb/" . $imageId .".jpg")) {
							$process = new ImageProcessor();
							$process->createThumbnail($dir, $this->microThumb['width'], $this->microThumb['height'], $this->upcPath . "microthumb/" . $imageId . ".jpg");
						}
						readFile($this->upcPath . "microthumb/" . $imageId . ".jpg");
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