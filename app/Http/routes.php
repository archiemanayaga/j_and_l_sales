<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', 'OrderController@index');
	Route::get('/flowers', 'FlowerController@index');
	Route::get('/accessories', 'AccessoryController@index');
	Route::get('/services', 'ServiceController@index');
});

Route::get('/home', 'HomeController@index');
