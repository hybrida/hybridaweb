<?php
	class Blog extends CModel {

		private function getTotalRowCount() {
			$con = Yii::app()->db;
			$sql = "SELECT * FROM blogpost";
			$com = $con->createCommand($sql);
			return $com->query()->rowCount;
		}

		private function getPostRows($count) {
			$count--;
			$rowcnt = $this->getTotalRowCount();
			$con = Yii::app()->db;
			$sql = "SELECT * FROM blogpost WHERE id BETWEEN " . ($rowcnt - $count) . " AND $rowcnt";
			$com = $con->createCommand($sql);
			return $com->query();
		}

		public function getLatestPosts($count = 90) {
			$raw_rows = $this->getPostRows($count);
			$con = Yii::app()->db;
			$rows = array();
			
			for ($i = 0; $i < $raw_rows->count(); ++$i) {
				$row = $raw_rows->read();
				$sql = "SELECT * FROM user WHERE id = " . $row["uid"];
				$com = $con->createCommand($sql);
				$res = $com->query();
				$user = $res->read();
				$row["uid"] = $user["firstName"] . " " . $user["lastName"];
				array_push($rows, $row);
			}
			return array_reverse($rows);
		}

		public function attributeNames() {
			return array();
		}
	}