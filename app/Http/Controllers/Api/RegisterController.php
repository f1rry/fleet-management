<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Transformers\RegisterTransformer;
use App\User;
use App\Fleet;
use App\Driver;
use App\Car;

class RegisterController extends Controller
{
    //
	public function register_user(RegisterRequest $request){
		//$this->validator($request->all())->validate();
		$user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pri_level' => $request->pri_level,
            'fleet_id' => 0,
            'driver_id' => 0
        ]);
        $token=$user->createToken('MyApp')->accessToken;
        $data=$user->first();
        $data->token=$token;

        return $this->response->item($data,new RegisterTransformer);
	}
}
