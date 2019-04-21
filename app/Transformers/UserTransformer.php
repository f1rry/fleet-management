<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform($user){

		return [
			'id' =>$user->id,
			'name' =>$user->name,
			'email' =>$user->email,
			'pri_level' =>$user->pri_level,
			'fleet_id' =>$user->fleet_id,
			'driver_id' =>$user->driver_id
		];
	}
}