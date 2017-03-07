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
	Route::post('orders/store', 'OrderController@store');

	Route::get('flowers', 'FlowerController@index');
	Route::post('flowers/store', 'FlowerController@store');
	Route::get('flowers/edit/{id}', 'FlowerController@edit');
	Route::put('flowers/update', 'FlowerController@update');
	Route::delete('flowers/delete', 'FlowerController@delete');

	Route::get('accessories', 'AccessoryController@index');
	Route::post('accessories/store', 'AccessoryController@store');
	Route::get('accessories/edit/{id}', 'AccessoryController@edit');
	Route::put('accessories/update', 'AccessoryController@update');
	Route::delete('accessories/delete', 'AccessoryController@delete');

	Route::get('services', 'ServiceController@index');
	Route::post('services/store', 'ServiceController@store');
	Route::get('services/edit/{id}', 'ServiceController@edit');
	Route::put('services/update', 'ServiceController@update');
	Route::delete('services/delete', 'ServiceController@delete');

	Route::get('reports/order', 'ReportController@index');
	Route::get('reports/accessory', 'ReportController@accessory');
	Route::get('reports/flower', 'ReportController@flower');
	Route::get('reports/service', 'ReportController@service');

    Route::get('customers/search', 'CustomerController@search');
});
