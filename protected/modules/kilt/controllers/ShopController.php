<?php

class ShopController extends Controller
{
	public function actionIndex()
	{
		$shop = new Shop();

		$categories = $shop->getCategories();
		$products = array();

		foreach($categories as $c)
			$products[$c] = $shop->getProductsByCategory($c);

		$this->render('index', 
				array(
					'categories' => $categories,
					'products'   => $products
					));
	}
}
