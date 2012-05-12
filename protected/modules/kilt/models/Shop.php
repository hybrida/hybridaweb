<?php

class Shop {

    public function getCategories(){
        $connection = Yii::app()->db;
		$command = $connection->createCommand("SELECT DISTINCT type FROM kilt_product");
		$data = $command->queryColumn(); 
        return $data;
    }

	public function getProductsByCategory($category)
	{
        $connection = Yii::app()->db;
		$command = $connection->createCommand("SELECT * FROM kilt_product WHERE type ='" . $category . "'");
		$data = $command->queryAll(); 
        return $data;
	}
}
