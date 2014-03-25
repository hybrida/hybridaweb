<?php
	class Blog extends CModel {

		private function getTotalRowCount() {
			$con = Yii::app()->db;
			$sql = "SELECT * FROM blogpost";
			$com = $con->createCommand($sql);
			return $com->query()->rowCount;
		}

		private function getPostRows($count) {
			$con = Yii::app()->db;
			$sql = "SELECT * FROM blogpost ORDER BY time DESC LIMIT $count";
			$com = $con->createCommand($sql);
			return $com->query();
		}

		public function getLatestPosts($count = 90) {
			$con = Yii::app()->db;

			$raw_rows = $this->getPostRows($count);
			$count = $this->getPostRows($count)->count();
			$rows = array();

			for ($i = 0; $i < $count; ++$i) {
				$row = $raw_rows->read();
				$sql = "SELECT * FROM user WHERE id = " . $row["uid"];
				$com = $con->createCommand($sql);
				$res = $com->query();
				$user = $res->read();
				$row["name"] = $user["firstName"] . " " . $user["lastName"];
				array_push($rows, $row);
			}
			// return array_reverse($rows);
			return $rows;
		}

		public function attributeNames() {
			return array();
		}
	}
