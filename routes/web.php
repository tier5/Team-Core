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
Route::group(['middleware' => 'prevent-back-history'], function () {
 
	Route::get('/', function(){
		Cache::flush();
		return redirect('login');
	})->name('login');

	//Auth::routes();

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes...
	Route::get('register', function(){
		return redirect('/');
	})->name('register');
	Route::post('register', 'Auth\RegisterController@register');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

   // Redirected If Authenticated
Route::group(['middleware' => ['auth','prevent-back-history']], function () {

	Route::get('dashboard', function () {
		Cache::flush();
	    return view('home.dashboard');
	});

	Route::get('/home',  function () {
	    return view('home.dashboard');
	});

	/*************product paths***********************/

	Route::get('productList', 'Product\ProductController@productList');
	Route::get('addProduct', function () {
	    return view('product.addProduct');
	});

	Route::post('createProduct', 'Product\ProductController@createProduct')->name('postCreateProduct');
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
	
});
