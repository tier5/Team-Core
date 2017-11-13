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

Route::get('/userLogin', function () {
    return view('login');
});

Route::get('/user-login', function () {
    return view('angular_login');
});
Route::post('/user-login', 'LoginController@login');


Route::group( [ 'middleware' => 'user'] , function(){

	Route::get('/', function () {
	    return view('angular_home');
	});

	Route::get('/index', function () {
	    return view('angular_index');
	});


	Route::get('/dashboard', function () {
	    return view('angular_dashboard');
	});

	
	Route::get('/user-logout', 'LoginController@logout');
	// Route::post('/login-test', 'UserController@index1')->middleware('cors');


	Route::get('/users/{id?}', 'UserController@index');
	Route::post('/users', 'UserController@store');
	Route::post('/add-user', 'UserController@store');
	Route::post('/update/{id}', 'UserController@update');
	Route::delete('/users/{id}', 'UserController@destroy');

});

Route::get('/test', function () {
   return view('test_index');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

