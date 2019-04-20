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
    return view('welcome');
});
/*
Route::prefix('fleet')->group(function(){
	Route::get('show','FleetController@show');
	Route::post('add','FleetController@add');
	Route::get('delete/{id}','FleetController@delete');
	Route::get('forbidden/{id}','FleetController@forbidden');
	Route::get('add_form','FleetController@add_form');
});

Route::prefix('car')->group(function(){
	Route::get('show/{id}','CarController@show');
	Route::post('add','CarController@add');
	Route::get('delete/{id}','CarController@delete');
	Route::get('add_form','CarController@add_form');
	Route::get('forbidden/{id}','CarController@forbidden');
});

Route::prefix('driver')->group(function(){
	Route::get('show/{id}','DriverController@show');
	Route::post('add','DriverController@add');
	Route::get('delete/{id}','DriverController@delete');
	Route::get('add_form','DriverController@add_form');
});


Route::prefix('mession')->group(function(){
	Route::get('show','MessionController@show');
	Route::post('add','MessionController@add');
	Route::get('delete/{id}','MessionController@delete');
	Route::get('add_form/{id}','MessionController@add_form');
});
*/
