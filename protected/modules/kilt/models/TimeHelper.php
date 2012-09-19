<?php

class TimeHelper
{
   // Adds time-interval
   public function addTime($start, $end)
   {
	  $connection = Yii::app()->db;
	  $data = array(
		 ':start' => $start,
		 ':end' => $end,
	  );
	  $sql = "INSERT INTO kilt_time
	  ( start,  end) 
	  VALUES (:start, :end)";
	  $command = $connection->createCommand($sql);
	  $command->execute($data);
   }

   // Returns all time-intervals indexed by id
   public function getTimes()
   {
	  $connection = Yii::app()->db;
	  $sql = "SELECT * FROM kilt_time";
	  $command = $connection->createCommand($sql);
	  $data = $command->queryAll(); 
	  $times = array();
	  foreach($data as $d)
		 $times[$d['id']] = $d;
	  return $times;
   }

   // Returns all on-going time-intervals
   public function getCurrentTime()
   {
	  $connection = Yii::app()->db;
	  $sql = "SELECT * FROM kilt_time WHERE start <= CURDATE() AND CURDATE() <= end";
	  $command = $connection->createCommand($sql);
	  $data = $command->queryRow(); 
	  return $data;
   }

   public function getCurrentTimeID()
   {
	  $connection = Yii::app()->db;
	  $sql = "SELECT id FROM kilt_time WHERE start <= CURDATE() AND CURDATE() <= end";
	  $command = $connection->createCommand($sql);
	  $data = $command->queryScalar(); 
	  if ($data == "")
	  	$data = -1;
	  return $data;
   }

   // Returns the last time-interval. if onlyEnded == true, it only returns time-intervals
   // that has not ended
   public function getLastTimeID()
   {
	  $connection = Yii::app()->db;
	  $sql = "SELECT MAX(id) as id from kilt_time";
	  $command = $connection->createCommand($sql);
	  $data = $command->queryScalar(); 
	  return $data;
   }

   // Returns true if there is an ongoing time-interval
   public function isShopOpen()
   {
	  $connection = Yii::app()->db;
	  $sql = "SELECT COUNT(*) FROM kilt_time WHERE start <= CURDATE() AND CURDATE() <= end";
	  $command = $connection->createCommand($sql);
	  $data = $command->queryScalar(); 
	  return $data > 0;
   }
}

?>
