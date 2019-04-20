<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\FleetRequest;
use App\Http\Controllers\Controller;
use App\Transformers\FleetTransformer;
use App\Driver;
use App\Car;
use App\Fleet;
use App\User;
use Hash;
use DB;
use Exception;

class FleetController extends Controller
{
    //
    protected $successCode=200;

    public function show(FleetRequest $request){
        //未通过授权策略，则会抛出\Illuminate\Auth\Access\AuthorizationException异常，由dingoapi自动
        $this->authorize('show',Fleet::class);
    	$fleets = Fleet::all();
    	return $this->response->collection($fleets, new FleetTransformer);
    }

    public function add(FleetRequest $request){
       	$this->authorize('add',Fleet::class);
        try{
            DB::transaction(function () use ($request) {
                $fleet = Fleet::create([
                    'fleet_name' => $request->fleet_name,
                    'user_id' => $request->user_id,
                    'status' => 1
                 ]);
                User::where('id','=',$request->user_id)->update(['fleet_id'=>$fleet->id]);
            });
            $fleet=Fleet::where('fleet_name',$request->fleet_name)->first();
            return $this->response->item($fleet,new FleetTransformer)->setStatusCode(201);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        } 
    }

    public function update(FleetRequest $request,int $fleet_id){
       	$this->authorize('update',Fleet::class);
        $fleet=Fleet::where('id','=',$fleet_id);
        try{
            DB::transaction(function () use ($request,$fleet) {
                $fleet->update([
        			'fleet_name' => $request->fleet_name,
        			'user_id' => $request->user_id,
        			'status' => $request->status
            	]);
                User::where('id','=',$request->user_id)->update(['fleet_id'=>$fleet_id]);
            });
            return $this->response->item($fleet->first(),new FleetTransformer);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        } 
    }

//需要删除底下所有车辆和司机
//测试完毕
    public function delete(FleetRequest $request,int $fleet_id){
     	$this->authorize('delete',Fleet::class);
        try{
            DB::transaction(function () use ($request,$fleet_id) {
                $cars = Car::where('fleet_id','=',$fleet_id)->get();
                //删除关联表中与该车队有关的信息
                foreach ($cars as $car ) {
                    $car->driver()->detach();
                    $car->delete();
                }
                Driver::where('fleet_id','=',$fleet_id)->delete();
                Fleet::where('id','=',$fleet_id)->delete();
                User::where('fleet_id','=',$fleet_id)->delete();    
            });
            return $this->response->noContent()->setStatusCode(200);
        }
        catch(Exception $e){
            return $this->response->error($e->getMessage(), 401);
        } 
    }
    
}
