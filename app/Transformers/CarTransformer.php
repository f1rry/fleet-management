<?php

namespace App\Transformers;

use App\Car;
use League\Fractal\TransformerAbstract;

class CarTransformer extends TransformerAbstract
{
	public function transform(Car $car){

		return [
			'id' =>$car->id,
			'license_plate' =>$car->license_plate,
			'max_load' =>$car->max_load,
			'max_maned' =>$car->max_maned,
			'status' =>$car->status
		];
	}
}