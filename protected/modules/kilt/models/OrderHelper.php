<?php

class OrderHelper
{
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
		$sql = "SELECT * FROM kilt_order";
		$command = $connection->createCommand($sql);
		$data = $command->queryAll(); 
        return $data;
	}

	public function deleteOrder($id)
	{
        $connection = Yii::app()->db;
		$sql = "DELETE FROM kilt_order WHERE id  = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$data = $command->execute(); 
	}

	public function updateOrder($id, $qnty, $timeID)
	{
        $connection = Yii::app()->db;
        $data = array(
            ':product_id' => $id,
            ':product_quantity' => $qnty,
			':user_id' => Yii::app()->user->id,
			':time_id' => $timeID,
        );
        $sql = "UPDATE kilt_order
				SET product_quantity = :product_quantity
		  		WHERE user_id = :user_id AND product_id = :product_id
				AND time_id = :time_id";
		$command = $connection->createCommand($sql);
        $command->execute($data);
	}

	public function addOrder($id, $tid, $qnty, $size)
	{
		$orders = $this->getUserOrders();

		foreach($orders as $o)
		{
			if ($o['product_id'] == $id &&
				$o['product_size'] == $size &&
				$o['time_id'] == $tid)
			{
				$this->updateOrder($id, $qnty + $o['product_quantity'], $tid);
				return;
			}
		}

        $connection = Yii::app()->db;
        $data = array(
            ':product_id' => $id,
            ':product_size' => $size,
            ':product_quantity' => $qnty,
			':user_id' => Yii::app()->user->id,
			':time_id' => $tid,
        );
        $sql = "INSERT INTO kilt_order
			 ( user_id,  product_id,  product_quantity,  product_size,  time_id) 
	  VALUES (:user_id, :product_id, :product_quantity, :product_size, :time_id)";
		$command = $connection->createCommand($sql);
        $command->execute($data);
	}

	public function cmpOrder($a, $b)
	{
		if ($a['product_id'] != $b['product_id'])
			return ($a['product_id'] - $b['product_id']);

		return ($a['product_size'] - $b['product_size']);
	}

	public function getUserOrdersIndexedByTime()
	{
        $connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "SELECT * FROM kilt_order WHERE user_id = :user_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$data = $command->queryAll(); 
		foreach($data as $d)
			$timeOrders[$d['time_id']][] = $d;
		foreach($timeOrders as $to)
			usort($to, array("OrderHelper", "cmpOrder"));
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
