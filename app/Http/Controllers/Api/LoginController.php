<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Http\Requests\LoginRequest;
use App\Transformers\LoginTransformer;
use GuzzleHttp\Client;

class LoginController extends Controller{
    
    public function login(LoginRequest $request){
    	$http = new Client;
    	$response = $http->post(env('HOST').'/index.php/oauth/token', [
   			'form_params' => [
        		'grant_type' => 'password',
        		'client_id' => env('client_id'),
        		'client_secret' => env('client_secret'),
        		'username' => $request->email,
        		'password' => $request->password,
        		'scope' => '',
    		],
		]);
        $access_token=json_decode((string)$response->getBody())->access_token;
        User::where('email',$request->email)->update(['access_token'=>$access_token]);
		return $this->response->item(json_decode((string)$response->getBody()), new LoginTransformer);
	}
}
