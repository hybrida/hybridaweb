<?php
	class BlogPost extends CModel {
		public $title, $content;

		public function attributeNames() {
			return array();
		}

		public function isDataPosted() {
			if (isset($_POST["BlogPost"])) {
				return true;
			}
			return false;
		}

		public function validateData() {
			$data = $_POST["BlogPost"];
			if ($data["title"] == "")
				return false;
			if (strlen($data["title"]) > 35)
				return false;
			if ($data["content"] == "")
				return false;
			if (strlen($data["content"]) < 2)
				return false;
			return true;
		}

		public function uploadToDataBase() {
			$con = Yii::app()->db;
			$sql = "INSERT INTO blogpost (title, content, uid) VALUES ('" . $_POST["BlogPost"]["title"] . "', '" . $_POST["BlogPost"]["content"] . "', " . Yii::app()->user->id . ")";
			$com = $con->createCommand($sql);
			$com->query();
		}
	}
