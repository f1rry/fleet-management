<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;
use App\Http\Controllers\Controller;
use App\Transformers\DriverTransformer;
use App\Driver;
use App\User;
use App\Fleet;
use DB;
use Exception;

class DriverController extends Controller
{
    //
	protected $successCode=200;

    //若为超级管理员则显示所有司机
    //若为公司管理员则显示本公司的所有司机 
    public function show(DriverRequest $request){
    	$this->authorize('show',Driver::class);
        if($request->user()->isFleetAdmin()){
    	    $result = Driver::where('fleet_id','=',$request->user()->fleet_id)->get();
        }
        elseif($request->user()->isSuperAdmin()){
            $result = Driver::all();
        }
        return $this->response->collection($result, new DriverTransformer);
    }

//超管需要传fleet_id
//公司管理只需传创建用户的角色
    public function add(DriverRequest $request){
        $fleet=Fleet::where('id','=',$request->fleet_id)->first();
    	$this->authorize('add',$fleet);
        try{
            DB::transaction(function () use ($request) {
                $driver_id = Driver::create([
                    'name' => $request->driver_name,
                    'old' => $request->old,
                    'sex' => $request->sex,
                    'fleet_id' => $request->fleet_id,
                    'user_id' => $request->user_id,
                    'status' => $request->status
                ])->id;
            User::where('id','=',$request->user_id)->update(['driver_id'=>$driver_id,
                'fleet_id'=>$request->fleet_id]);
            });
            $driver=Driver::where('name',$request->driver_name)->first();
            return $this->response->item($driver,new DriverTransformer)->setStatusCode(201);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        }   	
    }

    public function update(DriverRequest $request,int $driver_id){
        $driver=Driver::where('id','=',$driver_id);
        $fleet=Fleet::where('id',$request->fleet_id)->first();
    	$this->authorize('update',$fleet);
        try{
            DB::transaction(function () use ($request,$driver,$driver_id){
                $driver->update([
            		'name' => $request->driver_name,
            		'old' => $request->old,
            		'sex' => $request->sex,
            		'status' => $request->status
            	]);
                if($request->user()->pri_level===1){
                    $driver->update(['fleet_id'=>$request->fleet_id]);
                    User::where('driver_id','=',$driver_id)->update(['fleet_id'=>$request->fleet_id]);
                }
            });
            return $this->response->item($driver->first(),new DriverTransformer)->setStatusCode(201);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        }
    }

//同时删除和其他汽车的管理，如果汽车除他以外其他都没关联，则删除
//测试完毕
    public function delete(DriverRequest $request,int $driver_id){
        $driver=Driver::where('id','=',$driver_id);
        $fleet=Fleet::where('id',$driver->first()->fleet_id)->first();
    	$this->authorize('delete',$fleet);
        try{
            DB::transaction(function () use ($request,$driver_id,$driver) {
                $driver->first()->car()->detach();
                $driver->delete();
                User::where('driver_id','=',$driver_id)->delete();
            });
            return $this->response->noContent()->setStatusCode(200);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        }
    }
    
}
