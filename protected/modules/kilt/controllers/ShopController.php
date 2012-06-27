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
		$products = array();
		$categories = $shop->getCategories();
		$sizes = $shop->getSizes();

		if (isset($_POST['submit']))
		{
			$size    = $_POST['size'];
			$qnty    = $_POST['qnty'];

			foreach ($qnty as $id => $q)
			{
				if ($q === "0")
					continue;

				// Sjekker at str er en integer og ikke tekst
				if (!is_numeric($q) || (int)$q != $q)
					$errors[$id][] = $q . " er ikke et godkjent antall";

				// Produktet har ikke størrelser
				if (!isset($size[$id]))
					$size[$id] = "0";

				// Size = -1 betyr at str ikke er valgt
				if ($size[$id] == "-1")
					$errors[$id][] = "Du må velge størrelse";

				if (!isset($errors[$id]))
					$orders[] = array('id' => $id,
									 'qnty' => $q,
									 'size' => $size[$id]);
			}

			// Bare bestill dersom det ikke var noen feil
			if (count($errors) == 0 && count($orders) > 0)
			{
				foreach($orders as $o)
					$shop->addOrder($o['id'], $o['qnty'], $o['size']);

				$this->actionOrders();
				return;
			}
		}

		// Les inn produkter fordelt på kategori og ta med størrelser
		foreach($categories as $c)
		{
			$newCatProducts = array();
			foreach ($shop->getProductsByCategory($c) as $cp)
			{
				$cp['sizes'] = $shop->getProductSizes($cp['id']);
				$newCatProducts[] = $cp;
			}
			$products[$c] = $newCatProducts;
		}

		$this->render('index', 
				array(
					'categories' => $categories,
					'products'   => $products,
					'sizes'		 => $sizes,
					'errors'     => $errors,
					'size'       => $size,
					'qnty'		 => $qnty,
					));
	}

	public function cmpOrder($a, $b)
	{
		if ($a['product_id'] != $b['product_id'])
			return ($a['product_id'] - $b['product_id']);

		return ($a['product_size'] - $b['product_size']);
	}

	public function actionOrders()
	{
		$shop = new Shop();

		if (sizeof($_POST) > 0)
			foreach($_POST as $key => $value)
				$shop->deleteOrder($key);

		$orders = $shop->getUserOrders();
		$products = $shop->getProducts();
		$sizes = $shop->getSizes();
		$sizes[0] = " - ";

		usort($orders, array("ShopController", "cmpOrder"));
		$this->render('orders',
				array(
					'orders' => $orders,
					'products' => $products,
					'sizes'	=> $sizes,
					'afterDeadline' => $shop->isAfterDeadline(),
					));
	}

	public function actionAdmin()
	{
		$shop = new Shop();

		if (isset($_POST['del']))
				$shop->deleteOrders();

		$products = $shop->getProducts();
		$orders = $shop->getOrders();
		$totalOrders = array();
		$sizes = $shop->getSizes();
		$sizes[0] = " - ";

		/*
		foreach ($products as $p)
		{
			$pid = $p['id'];
			$psizes = $shop->getProductSizes($p['id']);
			if (sizeof($psizes) > 0)
			{
				foreach ($psizes as $s)
				{
					$sid = $s['id'];
					$totalOrders[$pid][$sid] = 0;
				}
			}
			else
				$totalOrders[$pid]['0'] = 0;
		}
		*/

		foreach($products as $p)
			$products[$p['id']] = $p;

		foreach ($orders as $o)
		{
			$id = $o['product_id'];
			$qnty = $o['product_quantity'];
			$size = $o['product_size'];

			if (isset($totalOrders[$id][$size]))
				$totalOrders[$id][$size] += $qnty;
			else
				$totalOrders[$id][$size] = $qnty;
		}

		$this->render('admin', 
				array(
					'orders' => $totalOrders,
					'products' => $products,
					'sizes' => $sizes,
					));	
	}
}
