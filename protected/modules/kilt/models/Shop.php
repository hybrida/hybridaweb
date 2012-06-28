<?php

class Shop {

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
	public function getCurrentTime()
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_time WHERE start <= CURDATE() AND CURDATE() <= end";
		$command = $connection->createCommand($sql);
		$data = $command->queryRow(); 
		return $data;
	}
	public function getLastTime($onlyEnded)
	{
        $connection = Yii::app()->db;
		if ($onlyEnded)
		$sql = "SELECT MAX(id) as id from kilt_time WHERE end < CURDATE()";
		else
			$sql = "SELECT MAX(id) as id from kilt_time";
		$command = $connection->createCommand($sql);
		$data = $command->queryRow(); 
		return $data;
	}
	public function isShopOpen()
	{
        $connection = Yii::app()->db;
		$sql = "SELECT COUNT(*) FROM kilt_time WHERE start <= CURDATE() AND CURDATE() <= end";
		$command = $connection->createCommand($sql);
		$data = $command->queryScalar(); 
        return $data > 0;
	}

    public function getCategories(){
        $connection = Yii::app()->db;
		$sql = "SELECT DISTINCT type FROM kilt_product";
		$command = $connection->createCommand($sql);
		$data = $command->queryColumn(); 
        return $data;
    }

	public function getProductsByCategory($category)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT id, type, model FROM kilt_product WHERE type = :category";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":category", $category);
		$data = $command->queryAll(); 
        return $data;
	}

	public function getProducts()
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_product";
		$command = $connection->createCommand($sql);
		$data = $command->queryAll(); 
		foreach($data as $d)
			$products[$d['id']] = $d;
        return $products;
	}

	public function getSizes()
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_size";
		$command = $connection->createCommand($sql);
		$data = $command->queryAll(); 
		foreach($data as $d)
			$sizes[$d['id']] = $d['size'];
		$sizes[0] = " - ";
        return $sizes;
	}

	public function getProductSizes($pid)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT size_id FROM kilt_product_size WHERE product_id = :pid";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":pid", $pid);
		$data = $command->queryColumn(); 
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

	public function getProductById($id)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_product WHERE id  = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$data = $command->queryRow(); 
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

	public function addOrder($id, $qnty, $size)
	{
		$orders = $this->getUserOrders();
		$curTime = $this->getCurrentTime();
		$timeID = $curTime['id'];

		foreach($orders as $o)
		{
			if ($o['product_id'] == $id &&
				$o['product_size'] == $size &&
				$o['time_id'] == $timeID)
			{
				$this->updateOrder($id, $qnty + $o['product_quantity'], $timeID);
				return;
			}
		}

        $connection = Yii::app()->db;
        $data = array(
            ':product_id' => $id,
            ':product_size' => $size,
            ':product_quantity' => $qnty,
			':user_id' => Yii::app()->user->id,
			':time_id' => $timeID,
        );
        $sql = "INSERT INTO kilt_order
			 ( user_id,  product_id,  product_quantity,  product_size,  time_id) 
	  VALUES (:user_id, :product_id, :product_quantity, :product_size, :time_id)";
		$command = $connection->createCommand($sql);
        $command->execute($data);
	}

	public function getUserOrders()
	{
        $connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "SELECT * FROM kilt_order WHERE user_id = :user_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$data = $command->queryAll(); 
        return $data;
	}
}
