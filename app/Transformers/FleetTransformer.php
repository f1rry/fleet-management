<?php

namespace App\Transformers;

use App\Fleet;
use League\Fractal\TransformerAbstract;

class FleetTransformer extends TransformerAbstract
{
	public function transform(Fleet $fleet){

		return [
			'id' =>$fleet->id,
			'fleet_name' =>$fleet->fleet_name,
			'owner_id' =>$fleet->user_id,
			'status' =>$fleet->status
		];
	}
}