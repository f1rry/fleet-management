<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use App\User;
use DB;

class UserController extends Controller
{
    //
    public function show(Request $request){
    	if($request->user()->isSuperAdmin()){
    		$users=User::where('pri_level','<>',1)->get();
    	}
    	else if($request->user()->isFleetAdmin()){
    		$users=User::where([['fleet_id',$request->user()->fleet_id],['pri_level','<>',2]])->get();
    	}
    	return $this->response->collection($users,new UserTransformer);
    }

    public function logout(Request $request){
        $user_id = $request->user()->id;
        $result = DB::table('oauth_access_tokens')->where('user_id',$user_id)->delete();

        // 找到这条access_token并且将其删除
        if ($result) {
            return $this->response->noContent()->setStatusCode(200);
        } else {
             return $this->response->noContent()->setStatusCode(500);
        }
    }
}
