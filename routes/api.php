<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::post('users','Api\RegisterController@register_user');
Route::get('infos','Api\RegisterController@information_for_register');
Route::post('login','Api\LoginController@login');

Route::middleware('auth:api')->group(function(){
	Route::post('roles','Api\RegisterController@register_role');

	//
	Route::get('fleets','Api\FleetController@show');
	Route::post('fleets','Api\FleetController@add');		
	Route::patch('fleets/{id}','Api\FleetController@update');
	Route::delete('fleets/{id}','Api\FleetController@delete');

	//
	Route::get('drivers','Api\DriverController@show');
	Route::post('drivers','Api\DriverController@add');		
	Route::patch('drivers/{id}','Api\DriverController@update');
	Route::delete('drivers/{id}','Api\DriverController@delete');

	//
	Route::get('cars','Api\CarController@show');
	Route::post('cars','Api\CarController@add');		
	Route::patch('cars/{id}','Api\CarController@update');
	Route::delete('cars/{id}','Api\CarController@delete');

});
*/
/*
	* 用户登录 POST /api/v1/login 
    * 用户注册 POST /api/v1/user
    * 角色注册 POST /api/v1/role
    * 车队列表 GET /api/v1/fleets
    * 车队添加 POST /api/v1/fleet
    * 车队修改 PATCH /api/v1/fleet/{id}
    * 车队删除 DELETE /api/v1/fleet/{id}
    * 车辆列表 GET /api/v1/cars
    * 车辆添加 POST /api/v1/car
    * 车辆修改 PATCHT /api/v1/car/{id}
    * 车辆删除 DELETE /api/v1/car/{id}
    * 司机列表 GET /api/v1/drivers
    * 司机添加 POST /api/v1/driver
    * 司机修改 PATCHT /api/v1/driver/{id}
    * 司机删除 DELETE /api/v1/driver/{id}
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1',function($api){
	$api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
		$api->post('user','RegisterController@register_user');
		$api->post('login','LoginController@login');

		$api->group(['middleware' => 'auth:api'],function ($api){
			//车队管理模块
			$api->get('fleets','FleetController@show');
			$api->post('fleet','FleetController@add');
			$api->patch('fleet/{id}','FleetController@update');
			$api->delete('fleet/{id}','FleetController@delete');


		//汽车管理模块
			$api->get('cars','CarController@show');
			$api->post('car','CarController@add');
			$api->patch('car/{id}','CarController@update');
			$api->delete('car/{id}','CarController@delete');

		//驾驶员管理模块
			$api->get('drivers','DriverController@show');
			$api->post('driver','DriverController@add');
			$api->patch('driver/{id}','DriverController@update');
			$api->delete('driver/{id}','DriverController@delete');
		});
	});
});
