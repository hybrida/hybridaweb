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
		$catProducts = array();
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
			$catProducts[$c] = $newCatProducts;
		}

		$this->render('index', 
				array(
					'catProducts'   => $catProducts,
					'sizes'		 => $sizes,
					'errors'     => $errors,
					'size'       => $size,
					'qnty'		 => $qnty,
					'isShopOpen' => $shop->isShopOpen(),
					));
	}

	public function cmpOrder($a, $b)
	{
		if ($a['product_id'] != $b['product_id'])
			return ($a['product_id'] - $b['product_id']);

		return ($a['product_size'] - $b['product_size']);
	}

	public function actionInfo()
	{
		$this->render('info');
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
		$isShopOpen = $shop->isShopOpen();
		$time = $shop->getCurrentTime();

		$timeOrders = array();
		$sortedTimeOrders = array();

		foreach($orders as $o)
			$timeOrders[$o['time_id']][] = $o;

		foreach($timeOrders as $to)
			usort($to, array("ShopController", "cmpOrder"));

		$this->render('orders',
				array(
					'timeOrders' => $timeOrders,
					'products' => $products,
					'sizes'	=> $sizes,
					'isShopOpen' => $isShopOpen,
					'time' => $time,
					'times' => $shop->getTimes(),
					));
	}

	public function actionAdmin()
	{
		$gk = Yii::app()->gatekeeper;
		$isWebkomMember = $gk->hasGroupAccess(55);
		if (!$isWebkomMember)
		{
			$this->render("error");
			return;
		}

		$shop = new Shop();
		$showTimeID = -1;
		$showUserID = -1;

		if (isset($_POST['showUser']))
		{
			$showUserID = $_POST['newuserid'];
			$showTimeID = $_POST['timeid'];
		}
		elseif (isset($_POST['createTime']) && 
				isset($_POST['start']) && 
				isset($_POST['end']))
		{
			$dateRegex = "#^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$#";
			$start = $_POST['start'];
			$end = $_POST['end'];

			if (preg_match($dateRegex, $start) && 
				preg_match($dateRegex, $end) && 
				$start < $end)
				$shop->addTime($start, $end);
			else
			{
				$showUserID = $_POST['userid'];
				$showTimeID = $_POST['timeid'];
			}
		}
			
		else
			foreach($_POST as $key => $value)
			{
				if ($value == "Vis bestillinger")
				{
					$showTimeID = $key;	
					$showUserID = $_POST['userid'];
				}
			}

		$curTime = $shop->getCurrentTime();
		$sizes = $shop->getSizes();
		$times = $shop->getTimes();
		$isShopOpen = $shop->isShopOpen();

		// Hvis tidsintervall ikke er satt og det finnes tidsintervaller
		if (sizeof($times) > 0 && $showTimeID == -1)
		{
			// Hvis et tidintervall er aktivt, vis dette
			if ($isShopOpen)
				$showTimeID = $curTime['id'];
			// Hvis ingen tidsintervaller er aktive
			else
			{
				// Se etter avsluttede tidsintervaller
				$lastTime = $shop->getLastTime(true);
				// Hvis ingen avsluttede tidsintervaller, velg siste intervall
				if (!isset($lastTime['id']))
					$lastTime = $shop->getLastTime(false);
				$showTimeID = $lastTime['id'];
			}
		}
		
		$products = $shop->getProducts();
		$orders = $shop->getOrders();
		$totalOrders = array();
		$userOrders = array();

		foreach ($orders as $o)
		{
			$uid = $o['user_id'];
			$id = $o['product_id'];
			$qnty = $o['product_quantity'];
			$size = $o['product_size'];
			$tid = $o['time_id'];

			if (isset($totalOrders[$tid][$id][$size]))
				$totalOrders[$tid][$id][$size] += $qnty;
			else
				$totalOrders[$tid][$id][$size] = $qnty;

			$userOrders[$uid][$tid][$id][$size] = $qnty;
		}

		foreach($userOrders as $uid => $timeOrders)
		{
			$name = $shop->getUserNameByID($uid);
			$userOrders[$uid]['name'] = $name['firstName']." ".
										$name['lastName'];
		}

		if (!isset($userOrders[$showUserID][$showTimeID]))
			$showUserID = -1;

		$this->render('admin', 
				array(
					'post' => $_POST,
					'userOrders' => $userOrders,
					'orders' => $totalOrders,
					'products' => $products,
					'sizes' => $sizes,
					'times' => $times,
					'showTimeID' => $showTimeID,
					'showUserID' => $showUserID,
					));	
	}
}
