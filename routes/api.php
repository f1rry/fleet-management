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
			$api->get('users','UserController@show');
			$api->get('logout','UserController@logout');
			
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
