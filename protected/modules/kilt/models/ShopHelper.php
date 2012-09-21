<?php

class ShopHelper {


	public function getProductsIndexedByCategory() {
	   $categoryProducts = array();
	   $products = $this->getProducts();
	   foreach($products as $p) {
	   		$categoryProducts[$p['type']][$p['id']] = $p;
		}
        return $categoryProducts;
	}

	public function getProductSizes($pid) {
        $connection = Yii::app()->db;
		$sql = "SELECT size_id FROM kilt_product_size WHERE product_id = :pid";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":pid", $pid);
		$data = $command->queryColumn(); 
        return $data;
	}

	public function getProducts() {
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_product";
		$command = $connection->createCommand($sql);
		$data = $command->queryAll(); 
		foreach($data as $d) {
		   $pid = $d['id'];
			$products[$pid] = $d;
			$products[$pid]['sizes'] = $this->getProductSizes($pid);
		 }
        return $products;
	}

	public function getSizes() {
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_size";
		$command = $connection->createCommand($sql);
		$data = $command->queryAll(); 
		foreach($data as $d) {
			$sizes[$d['id']] = $d['size'];
		}
		$sizes[0] = " - ";
        return $sizes;
	}

	public function getImageDir()
	{
	   return "/images/kilt/produkter/";
	}
}
