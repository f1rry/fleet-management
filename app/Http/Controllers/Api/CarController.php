<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Http\Controllers\Controller;
use App\Transformers\CarTransformer;
use App\Car;
use App\Driver;
use App\Fleet;
use App\User;
use DB;
use Exception;

//测试ok
class CarController extends Controller
{
    //

    public function show(CarRequest $request){
        $this->authorize('show',Car::class);
        if($request->user()->isDriver()){
            $result = Driver::where('user_id','=',$request->user()->id)->first()->car()->get();
        }
        elseif($request->user()->isFleetAdmin()){
            $result = Car::where('fleet_id','=',$request->user()->fleet_id)->get();
        }
        elseif($request->user()->isSuperAdmin()){
            $result = Car::all();
        }
        return $this->response->collection($result,new CarTransformer);

    }

//若车牌已存在，则只建立关联
//若车牌不存在，则添加car信息到cars表和关联
//测试ok
    public function add(CarRequest $request){
        $this->authorize('add',Car::class);
        try{
            DB::transaction(function () use ($request) {
            //超管和公司管理员添加车辆时只需添加driver_id
                $driver=Driver::where('id','=',$request->driver_id)->first();
                $car = new Car([
                    'license_plate' => $request->license_plate,
                    'max_load' => $request->max_load,
                    'max_maned' => $request->max_maned,
                    'status' => $request->status,
                    'fleet_id' => $driver->fleet_id
                ]);
                $driver->car()->save($car);
            });
            $car=Car::where('license_plate',$request->license_plate)->first();
            return $this->response->item($car,new CarTransformer)->setStatusCode(201);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        }         
    }

//取出中间表中所有跟driver有关的car的id
//修改其他策略
//sync会向中间表中添加传入的id，并删除其他不存在其中的id行
    public function update(CarRequest $request,int $car_id){
        $car_id=$car_id;
        $car=Car::where('id','=',$car_id);
        $fleet=Fleet::where('id',$car->first()->fleet_id)->first();
        $this->authorize('update',$fleet);
        try{
            DB::transaction(function () use ($request,$car) {
                $car->update([
                    'license_plate' => $request->license_plate,
                    'max_load' => $request->max_load,
                    'max_maned' => $request->max_maned,
                    'status' => $request->status
                ]);
                $driver_ids = $request->driver_ids;
                $car->first()->driver()->sync($driver_ids);
                $car->update(['fleet_id'=>Driver::whereIN('id',$driver_ids)->first()->fleet_id]);
            });
            return $this->response->item($car->first(),new CarTransformer);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        }  
    }

//delete无法删除中间表
//detach可删除
//公司管理员删除车辆，需判断该车是否属于本公司，如果是则直接删除，同时删除中间关联。
//超级管理员直接删除车辆，同时删除中间关联
//司机测试ok
    public function delete(CarRequest $request,int $car_id){
    	$driver=Driver::where('id','=',$request->user()->driver_id)->first();
        $car=Car::where('id','=',$car_id);
        $fleet=Fleet::where('id',$car->first()->fleet_id)->first();
        //如果车辆属主只有一个，则同时删除这个车辆，否则保留车辆
        $this->authorize('delete',$fleet);
        try{
            DB::transaction(function () use ($car_id,$car) {
                DB::table('driver_car')->where('car_id','=',$car_id)->delete();
                $car->delete();    
            });
            return $this->response->noContent()->setStatusCode(200);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        } 
    }

}
