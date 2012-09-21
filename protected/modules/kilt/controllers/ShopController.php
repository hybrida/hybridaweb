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
		$commentHelper = new CommentHelper();
		$timeHelper = new TimeHelper();

		$sizes = $shopHelper->getSizes();
		$categoryProducts = $shopHelper->getProductsIndexedByCategory();

		$curTimeID = $timeHelper->getCurrentTimeID();
		$isShopOpen = $timeHelper->isShopOpen();

		$comment = $commentHelper->getUserCommentByTimeID($curTimeID);
		

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

				$comment = $newComment;
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


		$this->render('index', 
				array(
				    'catProducts'=> $categoryProducts,
					'sizes'		 => $sizes,
					'errors'     => $errors,
					'size'       => $size,
					'qnty'		 => $qnty,
					'isShopOpen' => $isShopOpen,
					'comment'    => $comment,
					'timeID'	 => $curTimeID,
					));
	}

	public function actionOrders()
	{
		$shopHelper = new ShopHelper();
		$commentHelper = new CommentHelper();
		$orderHelper = new OrderHelper();
		$timeHelper = new TimeHelper();

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
		$times		= $timeHelper->getTimes();

		$timeComments = $commentHelper->getUserCommentsIndexedByTime();
		$timeOrders = $orderHelper->getUserOrdersIndexedByTime();

		$this->render('orders',
				array(
					'timeOrders' => $timeOrders,
					'products'   => $products,
					'sizes'	     => $sizes,
					'isShopOpen' => $isShopOpen,
					'time'       => $time,
					'times'      => $times,
					'timeComments'   => $timeComments,
					));
	}

	public function actionAdmin()
	{
		$gk = Yii::app()->gatekeeper;
		if (!$gk->hasGroupAccess(55))
		{
			$this->render("error");
			return;
		}

		$shopHelper = new ShopHelper();
		$orderHelper = new OrderHelper();
		$timeHelper = new TimeHelper();
	    $commentHelper = new CommentHelper();

		$showTimeID = -1;
		$showUserID = -1;

		if (isset($_POST['showUser']))
		{
			$showUserID = $_POST['newuserid'];
			$showTimeID = $_POST['timeid'];
		}
		else if (isset($_POST['updateOrder']))
		{
			$showUserID = $_POST['userid'];
			$showTimeID = $_POST['timeid'];
			foreach($_POST['recv'] as $id => $value)
				$orderHelper->setOrderRecv($id, $value);
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
				$timeHelper->addTime($start, $end);
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
				}
			}

		$currentTimeID    = $timeHelper->getCurrentTimeID();
		$times      = $timeHelper->getTimes();
		$isShopOpen = $timeHelper->isShopOpen();

		$sizes = $shopHelper->getSizes();

		if ($showTimeID == -1 && $currentTimeID == -1)
			$showTimeID = $timeHelper->getLastTimeID();
		elseif ($showTimeID == -1)
			$showTimeID = $currentTimeID;
		
		$products = $shopHelper->getProducts();
		$orders = $orderHelper->getOrders();

		 $commentsByName = $commentHelper->getCommentsByTimeIDIndexedByName($showTimeID);

		$totalOrders = array();
		$userOrders = array();


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

			if (!isset($userOrders[$uid]['name']))
			{
			   $name = $commentHelper->getUserNameByID($uid);
			   $userOrders[$uid]['name'] =	$name['firstName']." ".  $name['lastName'];
		   	}
		}


		if (!isset($userOrders[$showUserID][$showTimeID]))
			$showUserID = -1;


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
