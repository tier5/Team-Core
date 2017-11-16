<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Model\Product;
use App\Model\Shop;
use View;
class Helper
{

    /**
     * @return int
     */
    public static function totalProduct()
    {
    	$products=Product::count();
    	return $products;
    }


    /**
     * @return int
     */
    public static function totalShop()
    {
      $shop=Shop::count();
      return $shop;
    }
}