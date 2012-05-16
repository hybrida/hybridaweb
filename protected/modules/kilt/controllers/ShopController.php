<?php

class ShopController extends Controller
{
	public function actionIndex()
	{
		$shop = new Shop();
		$errors = array();
		$size = array();
		$qnty = array();
		$orders = array();

		if (isset($_POST['submit']))
		{
			$size    = $_POST['size'];
			$qnty    = $_POST['qnty'];

			foreach ($qnty as $id => $q)
			{
				if ($q === "0")
					continue;

				if (!is_numeric($q) || (int)$q != $q)
					$errors[$id][] = $q . " er ikke et godkjent antall";

				if (!isset($size[$id]))
					$size[$id] = "N/A";

				if ($size[$id] == "none")
					$errors[$id][] = "Du må velge størrelse";

				if (!isset($errors[$id]))
					$orders[] = array('id' => $id,
									 'qnty' => $q,
									 'size' => $size[$id]);
			}

			if (count($errors) == 0 && count($orders) > 0)
			{
				foreach($orders as $o)
					$shop->addOrder($o['id'], $o['qnty'], $o['size']);

				$this->actionOrders();
				return;
			}
		}


		$categories = $shop->getCategories();
		$products = array();

		foreach($categories as $c)
			$products[$c] = $shop->getProductsByCategory($c);

		$this->render('index', 
				array(
					'categories' => $categories,
					'products'   => $products,
					'errors'     => $errors,
					'size'       => $size,
					'qnty'		 => $qnty,
					));
	}

	public function cmpOrder($a, $b)
	{
		if ($a['product_id'] != $b['product_id'])
			return ($a['product_id'] - $b['product_id']);

		$sizes = array('Small', 'Medium', 'Medium Long', 'Large',
					   'XLarge', 'XXLarge');

		$aSizeNum = array_search($a['product_size'], $sizes);
		$bSizeNum = array_search($b['product_size'], $sizes);

		return ($aSizeNum - $bSizeNum);
	}

	public function actionOrders()
	{
		$shop = new Shop();
		$orders = $shop->getUserOrders();
		$products = $shop->getProducts();

		foreach($products as $p)
			$products[$p['id']] = $p;

		usort($orders, array("ShopController", "cmpOrder"));
		$this->render('orders',
				array(
					'orders' => $orders,
					'products' => $products,
					));
	}

	public function actionTotal()
	{
		$shop = new Shop();
		$products = $shop->getProducts();
		$orders = $shop->getOrders();
		$totalOrders = array();

		foreach ($products as $p)
		{
			if ($p['sizes'])
			{
				$sizes = explode(":", $p['sizes']); 
				foreach ($sizes as $s)
					$totalOrders[$p['id']][$s] = 0;
			}
			else
				$totalOrders[$p['id']]['N/A'] = 0;
		}

		foreach($products as $p)
			$products[$p['id']] = $p;

		foreach ($orders as $o)
		{
			$id = $o['product_id'];
			$qnty = $o['product_quantity'];
			$size = $o['product_size'];

			$totalOrders[$id][$size] += $qnty;
		}

		$this->render('total', 
				array(
					'orders' => $totalOrders,
					'products' => $products
					));	
	}
}
