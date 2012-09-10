<?php

class ShopController extends Controller
{
	public function actionIndex()
	{
		$this->render('info');
	}

	public function actionShop()
	{
		$errors = array();
		$size = array();
		$qnty = array();
		$orders = array();

		$shopHelper = new ShopHelper();
		$categories = $shopHelper->getCategories();
		$sizes = $shopHelper->getSizes();


		$timeHelper = new TimeHelper();
		$curTime = $timeHelper->getCurrentTime();
		$isShopOpen = $timeHelper->isShopOpen();
		$curTimeID = $curTime['id'];

		$commentHelper = new CommentHelper();
		$userComments = $commentHelper->getUserComments();
		$comment = "";
		if ($isShopOpen && isset($userComments[$curTimeID]))
			$comment = $userComments[$curTimeID];

		

		if (isset($_POST['submit']))
		{
			$size    = $_POST['size'];
			$qnty    = $_POST['qnty'];
			$newComment = $_POST['comment'];

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

			if ($newComment != $comment)
			{
				if (empty($comment))
					$commentHelper->insertComment($newComment, $curTimeID);
				elseif (empty($newComment))
					$commentHelper->deleteComment($curTimeID);
				else
					$commentHelper->updateComment($newComment, $curTimeID);

				$userComments = $commentHelper->getUserComments();
				$comment = "";
				if (isset($userComments[$curTimeID]))
					$comment = $userComments[$curTimeID];
			}

			// Bare bestill dersom det ikke var noen feil
			if (count($errors) == 0 && count($orders) > 0)
			{
			   $orderHelper = new OrderHelper();

				foreach($orders as $o)
				   $orderHelper->addOrder($o['id'], $curTimeID, $o['qnty'], $o['size']);

				$this->actionOrders();
				return;
			}
		}

		// Les inn produkter fordelt på kategori og ta med størrelser
		$categoryProducts = array();
		foreach($categories as $category)
		{
			$newCategoryProducts = array();
			foreach ($shopHelper->getProductsByCategory($category) as $categoryProduct)
			{
				$categoryProduct['sizes'] = $shopHelper->getProductSizes($categoryProduct['id']);
				$newCategoryProducts[] = $categoryProduct;
			}
			$categoryProducts[$category] = $newCategoryProducts;
		}

		$this->render('index', 
				array(
					'catProducts'   => $categoryProducts,
					'sizes'		 => $sizes,
					'errors'     => $errors,
					'size'       => $size,
					'qnty'		 => $qnty,
					'isShopOpen' => $isShopOpen,
					'comment'    => $comment,
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
		$shopHelper = new ShopHelper();
		$commentHelper = new commentHelper();
		$orderHelper = new orderHelper();
		$timeHelper = new timeHelper();

		if (sizeof($_POST) > 0)
			foreach($_POST as $key => $value)
				if ($value == "Fjern produkt")
				   $orderHelper->deleteOrder($key);
				elseif ($value == "Fjern info")
					$commentHelper->deleteComment($key);

		$products = $shopHelper->getProducts();
		$sizes    = $shopHelper->getSizes();

		$isShopOpen = $timeHelper->isShopOpen();
		$time       = $timeHelper->getCurrentTime();

		$comments = $commentHelper->getUserComments();

		$orders = $orderHelper->getUserOrders();

		$timeOrders = array();
		// Sort orders by time_id
		foreach($orders as $o)
			$timeOrders[$o['time_id']][] = $o;

		// Sort  orders by product_id within times
		foreach($timeOrders as $to)
			usort($to, array("ShopController", "cmpOrder"));

		// Sort comments by time_id
		foreach($comments as $tid => $c)
			$timeOrders[$tid][] = array();

		$this->render('orders',
				array(
					'timeOrders' => $timeOrders,
					'products'   => $products,
					'sizes'	     => $sizes,
					'isShopOpen' => $isShopOpen,
					'time'       => $time,
					'times'      => $timeHelper->getTimes(),
					'comments'   => $comments,
					));
	}

	public function actionAdmin()
	{
	   // Sjekker om brukeren har tilgang
		$gk = Yii::app()->gatekeeper;
		$isWebkomMember = $gk->hasGroupAccess(55);
		if (!$isWebkomMember)
		{
			$this->render("error");
			return;
		}

		$shopHelper = new ShopHelper();
		$orderHelper = new OrderHelper();
		$timeHelper = new TimeHelper();

		// default values
		$showTimeID = -1;
		$showUserID = -1;

		if (isset($_POST['showUser']))
		{
		   // An user has been selected in the dropdown
			$showUserID = $_POST['newuserid'];
			$showTimeID = $_POST['timeid'];
		}
		else if (isset($_POST['updateOrder']))
		{
		   // An order has been checked/unchecked
			$showUserID = $_POST['userid'];
			$showTimeID = $_POST['timeid'];
			foreach($_POST['recv'] as $id => $value)
				$orderHelper->setOrderRecv($id, $value);
		}
		elseif (isset($_POST['createTime']) && 
				isset($_POST['start']) && 
				isset($_POST['end']))
		{
		   // A new time-interval has been added
			$dateRegex = "#^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$#";
			$start = $_POST['start'];
			$end = $_POST['end'];

			// The time is in an accepted format
			if (preg_match($dateRegex, $start) && 
				preg_match($dateRegex, $end) && 
				$start < $end)
				$timeHelper->addTime($start, $end);
			// The time-format is not accepted, fails silently
			else
			{
				$showUserID = $_POST['userid'];
				$showTimeID = $_POST['timeid'];
			}
		}
			
		else
			foreach($_POST as $key => $value)
			{
			   // Et tidsintervall har blitt valgt
				if ($value == "Vis bestillinger")
				{
					$showTimeID = $key;	
					$showUserID = $_POST['userid'];
				}
			}

		$curTime    = $timeHelper->getCurrentTime();
		$times      = $timeHelper->getTimes();
		$isShopOpen = $timeHelper->isShopOpen();

		$sizes = $shopHelper->getSizes();

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
				$lastTime = $timeHelper->getLastTime(true);
				// Hvis ingen avsluttede tidsintervaller, velg siste intervall
				if (!isset($lastTime['id']))
					$lastTime = $timeHelper->getLastTime(false);
				$showTimeID = $lastTime['id'];
			}
		}
		
		$products = $shopHelper->getProducts();
		$orders = $orderHelper->getOrders();

		$totalOrders = array();
		$userOrders = array();
		$comments = array();

		if ($showTimeID != -1)
		  {
			 $commentHelper = new CommentHelper();
			 $comments = $commentHelper->getCommentsByTimeID($showTimeID);
		  }

		foreach ($orders as $o)
		{
			$uid = $o['user_id'];
			$id = $o['product_id'];
			$oid = $o['id'];
			$qnty = $o['product_quantity'];
			$size = $o['product_size'];
			$tid = $o['time_id'];
			$recv = $o['confirmed'];

			if (!isset($totalOrders[$tid][$id][$size]))
			{
				$totalOrders[$tid][$id][$size]['qnty'] = 0;
				$totalOrders[$tid][$id][$size]['recv'] = 0;
			}

			$totalOrders[$tid][$id][$size]['qnty'] += $qnty;

			$userOrders[$uid][$tid][$id][$size]['qnty'] = $qnty;
			$userOrders[$uid][$tid][$id][$size]['recv'] = $recv;
			$userOrders[$uid][$tid][$id][$size]['id'] = $oid;

			if (!isset($userOrders[$uid]['done'][$tid]))
				$userOrders[$uid]['done'][$tid] = 0;

			if ($recv)
				$totalOrders[$tid][$id][$size]['recv'] += $qnty;
			else
				$userOrders[$uid]['done'][$tid] += 1;


		}

		foreach($userOrders as $uid => $timeOrders)
		{
			$name = $shopHelper->getUserNameByID($uid);
			$userOrders[$uid]['name'] =	$name['firstName']." ".
										$name['lastName'];
		}

		if (!isset($userOrders[$showUserID][$showTimeID]))
			$showUserID = -1;

		$commentsByName = array();
		foreach($comments as $c)
		{
			$name = $shopHelper->getUserNameByID($c['user_id']);
			$name = $name['firstName']." ".  $name['lastName'];
			$commentsByName[$name] = $c['comment'];
		}

		$this->render('admin', 
				array(
					'post' => $_POST,
					'userOrders' => $userOrders,
					'orders' => $totalOrders,
					'products' => $products,
					'comments' => $commentsByName,
					'sizes' => $sizes,
					'times' => $times,
					'showTimeID' => $showTimeID,
					'showUserID' => $showUserID,
					));	
	}
}
