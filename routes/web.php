<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','HomeController@index');
Route::get('dang-ky', 'HomeController@register');
Route::post('dang-ky', 'HomeController@doRegister');
Route::get('dang-nhap', 'HomeController@login');
Route::post('dang-nhap', 'HomeController@doLogin');
Route::get('logout', 'HomeController@logout');
Route::get('search', 'HomeController@getDataSearch');
/*== AJAX ====*/
Route::group(['prefix' => 'userprofile'], function(){
	Route::get('/', 'HomeController@userprofile');
	//
	Route::get('/updateAccount', 'UserController@updateAccount');
	Route::get('/updateEmail', 'UserController@updateEmail');
	Route::get('/updatePassword', 'UserController@updatePassword');
});
//Route::get('them-su-kien', 'EventController')

Route::get('them-dia-diem', 'RestaurantController@addRestaurant');
Route::post('them-dia-diem', 'RestaurantController@doAddRestaurant');
Route::get('update-dia-diem/{slug}/{id}', 'RestaurantController@edit');
Route::post('update-dia-diem/{slug}/{id}', 'RestaurantController@update');
Route::get('xoa-dia-diem/{slug}/{id}', 'RestaurantController@destroy');

Route::get('/them-su-kien', 'EventRestaurantController@create');
Route::post('/them-su-kien', 'EventRestaurantController@store');
Route::get('/ds-su-kien', 'EventRestaurantController@show');
Route::get('/update-su-kien/{slug}/{id}', 'EventRestaurantController@edit');
Route::post('/update-su-kien/{slug}/{id}', 'EventRestaurantController@update');
Route::get('/xoa-su-kien/{slug}/{id}', 'EventRestaurantController@destroy');

Route::get('chuyen-muc/{slug}/{id}', 'HomeController@searchCate');
Route::get('su-kien/{slug}/{id}', 'HomeController@searchEvent');

Route::group(['prefix' => 'goto/backend'], function(){
	Route::get('/', function(){
		redirect('goto/backend/dashboard');
	});
	Route::get('dashboard', 'BackendController@dashboard');
	Route::get('restaurant', 'RestaurantController@index');
	Route::group(['prefix' => 'user'], function(){
		Route::get('add', 'UserController@create');
		Route::post('add', 'UserController@store');
		Route::get('show', 'UserController@show');

		Route::get('edit/{id}', 'UserController@edit');
		Route::post('edit/{id}', 'UserController@update');
		Route::get('delete/{id}', 'UserController@destroy');
	});

	Route::group(['prefix' => 'cate'], function(){
		Route::get('add', 'CateController@create');
		Route::post('add', 'CateController@store');
		Route::get('show', 'CateController@show');

		Route::get('edit/{id}', 'CateController@edit');
		Route::post('edit/{id}', 'CateController@update');
		Route::get('delete/{id}', 'CateController@destroy');
	});
	Route::group(['prefix' => 'event'], function(){
		Route::get('add', 'EventController@create');
		Route::post('add', 'EventController@store');
		Route::get('show', 'EventController@show');

		Route::get('edit/{id}', 'EventController@edit');
		Route::post('edit/{id}', 'EventController@update');
		Route::get('delete/{id}', 'EventController@destroy');
	});

	Route::group(['prefix' => 'eventrestaurant'], function(){
		Route::get('/', 'EventRestaurantController@index');
	});
});


// Route::get('fire', function () {
//     // this fires the event
//     event(new App\Events\EventDemo());
//     return "event fired";
// });

// Route::get('test', function () {
//     // this checks for the event
//     return view('demo');
// });