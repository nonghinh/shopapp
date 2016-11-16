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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'goto/backend'], function(){
	Route::get('/', function(){
		return view('backend.app');
	});
});
Route::get('fire', function () {
    // this fires the event
    event(new App\Events\EventDemo());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('demo');
});