<?php

class OrderHelper
{
	private $statusPublished = Status::PUBLISHED;
	private $statusDeleted = Status::DELETED;

	public function getUserNameByID($id) {
		$connection = Yii::app()->db;
		$sql = "SELECT firstName, lastName FROM user WHERE id = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$data = $command->queryRow(); 
		return $data;
	}

	public function getOrders()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_order WHERE status = :enabled";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":enabled", $this->statusPublished);
		$data = $command->queryAll(); 
		return $data;
	}

	public function deleteOrder($id)
	{
		$connection = Yii::app()->db;
		$sql = "UPDATE kilt_order
				SET status = :deleted
				WHERE id = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$command = $command->bindParam(":deleted", $this->statusDeleted);
		$data = $command->execute(); 
	}

	public function updateOrder($id, $qnty)
	{
		$connection = Yii::app()->db;
		$data = array(
			':id' => $id,
			':product_quantity' => $qnty,
		);
		$sql = "UPDATE kilt_order
				SET product_quantity = :product_quantity
		  		WHERE id = :id";
		$command = $connection->createCommand($sql);
		$command->execute($data);
	}

	public function addOrder($pid, $tid, $qnty, $size)
	{
		$orders = $this->getUserOrders();

		foreach($orders as $o)
		{
			if ($o['product_id'] == $pid &&
				$o['product_size'] == $size &&
				$o['time_id'] == $tid &&
				$o['status'] == $this->statusPublished)
			{
				$this->updateOrder($o['id'], $qnty + $o['product_quantity']);
				return;
			}
		}

		$connection = Yii::app()->db;
		$data = array(
			':product_id' => $pid,
			':product_size' => $size,
			':product_quantity' => $qnty,
			':user_id' => Yii::app()->user->id,
			':time_id' => $tid,
			':enabled' => $this->statusPublished,
		);
		$sql = "INSERT INTO kilt_order
			 ( user_id,  product_id,  product_quantity,  product_size,  time_id,  status) 
	  VALUES (:user_id, :product_id, :product_quantity, :product_size, :time_id, :enabled)";
		$command = $connection->createCommand($sql);
		$command->execute($data);
	}

	public function cmpOrder($a, $b)
	{
		if ($a['product_id'] != $b['product_id'])
			return ($a['product_id'] - $b['product_id']);

		return ($a['product_size'] - $b['product_size']);
	}

	public function getUserOrders()
	{
		$connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "SELECT * FROM kilt_order WHERE user_id = :user_id AND status = :enabled";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$command = $command->bindParam(":enabled", $this->statusPublished);
		$data = $command->queryAll(); 
		return $data;
	}

	public function getUserOrdersIndexedByTime()
	{
	   $data = $this->getUserOrders();
		$timeOrders = array();
		foreach($data as $d) {
			$timeOrders[$d['time_id']][] = $d;
		}
		foreach($timeOrders as &$to) {
			usort($to, array("OrderHelper", "cmpOrder"));
		}
		return $timeOrders;
	}

	public function setOrderRecv($id, $value)
	{
		$connection = Yii::app()->db;
		$data = array(
			':id' => $id,
			':confirmed' => $value,
		);
		$sql = "UPDATE kilt_order
				SET confirmed = :confirmed
		  		WHERE id = :id";
		$command = $connection->createCommand($sql);
		$command->execute($data);
	}
}

?>
