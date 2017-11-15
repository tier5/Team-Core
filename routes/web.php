<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.dashboard');
});

/*************product paths***********************/

Route::get('productList', 'Product\ProductController@productList');
Route::get('addProduct', function () {
    return view('product.addProduct');
});

Route::post('createProduct', 'Product\ProductController@createProduct');
Route::post('deleteProduct', 'Product\ProductController@deleteProduct');
Route::get('editProduct/{name}/{id}', 'Product\ProductController@editProduct');
Route::post('updateProduct', 'Product\ProductController@updateProduct');

/*************end of product paths***********************/

/**************shop paths ***************************/

Route::get('shopList', 'Shop\ShopController@shopList');
Route::get('addShop', 'Shop\ShopController@addShop');
Route::post('createShop', 'Shop\ShopController@createShop');
Route::post('deleteShop', 'Shop\ShopController@deleteShop');
Route::get('editShop/{name}/{id}', 'Shop\ShopController@editShop');
Route::post('updateShop', 'Shop\ShopController@updateShop');
Route::get('ShopProducts/{name}/{id}', 'Shop\ShopController@ShopProducts');


	///////////********** shop product details ***********///////////////

	Route::post('addShopProducts', 'Shop\ShopController@addShopProducts');
	Route::post('shopProductPrice', 'Shop\ShopController@shopProductPrice');
	Route::post('detachProduct', 'Shop\ShopController@detachProduct');
	



/**************end of shop paths************************/