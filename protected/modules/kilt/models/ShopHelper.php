
<?php

class ShopHelper {

	public function getUserNameByID($id)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT firstName, lastName FROM user WHERE id = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$data = $command->queryRow(); 
        return $data;
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

	public function getProductById($id)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_product WHERE id  = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$data = $command->queryRow(); 
        return $data;
	}
}
