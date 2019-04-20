<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class LoginTransformer extends TransformerAbstract
{
	public function transform($response){

		return [
			'token_type' =>$response->token_type,
			'expires_in' =>$response->expires_in,
			'access_token' =>$response->access_token,
			'refresh_token' =>$response->refresh_token
		];
	}
}