<?php

class File{
    public function Upload(){
        $dir = get_dir("$dir/images");
		foreach ($_FILES["images"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				if (validateImage($_FILES["images"])) {
					$oldName = $_FILES["images"]["name"][$key];
					query("INSERT INTO image VALUES(null, '', '$oldName', -1, $selfId, NOW(), 1)");
					$tmp_name = $_FILES["images"]["tmp_name"][$key];
					$name = mysql_insert_id() . ".jpg";
					move_uploaded_file($tmp_name, "$dir/$name");
					chmod("$dir/$name", 0770);
				}
			}
		}
    }
    
    public function put_image($data, $extension, $userId) {
	$image = new Image;
        $image->userId=$userId;
	$image->save();
        $url = '/yii/upc/images/'.$image->id . $extension;
        file_put_contents($url, $data);
	$image->url =$url;
	$image->save();
    }

}