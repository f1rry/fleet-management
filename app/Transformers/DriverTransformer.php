<?php

namespace App\Transformers;

use App\Driver;
use League\Fractal\TransformerAbstract;

class DriverTransformer extends TransformerAbstract
{
	public function transform(driver $driver){

		return [
			'id' =>$driver->id,
			'name' =>$driver->name,
			'old' =>$driver->old,
			'sex' =>$driver->sex,
			'fleet_id' =>$driver->fleet_id
		];
	}
}