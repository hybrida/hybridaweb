<?php

class Shop {

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
		$sql = "SELECT * FROM kilt_product WHERE type = :category";
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
        return $data;
	}

	public function getOrders()
	{
        $connection = Yii::app()->db;
		$sql = "SELECT product_id, product_size, product_quantity FROM kilt_order";
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

	public function updateOrder($id, $qnty)
	{
        $connection = Yii::app()->db;
        $data = array(
            ':product_id' => $id,
            ':product_quantity' => $qnty,
			':user_id' => Yii::app()->user->id,
        );
        $sql = "UPDATE kilt_order
				SET product_quantity = :product_quantity
		  		WHERE user_id = :user_id AND product_id = :product_id";
		$command = $connection->createCommand($sql);
        $command->execute($data);
	}

	public function addOrder($id, $qnty, $size)
	{
		$orders = $this->getUserOrders();

		foreach($orders as $o)
		{
			if ($o['product_id'] == $id &&
				$o['product_size'] == $size)
			{
				$this->updateOrder($id, $qnty + $o['product_quantity']);
				return;
			}
		}

        $connection = Yii::app()->db;
        $data = array(
            ':product_id' => $id,
            ':product_size' => $size,
            ':product_quantity' => $qnty,
			':user_id' => Yii::app()->user->id,
        );
        $sql = "INSERT INTO kilt_order
				 ( user_id,  product_id,  product_quantity,  product_size) 
		  VALUES (:user_id, :product_id, :product_quantity, :product_size)";
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