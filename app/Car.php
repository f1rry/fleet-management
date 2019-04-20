<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //

    protected $fillable = [
        'status','license_plate','max_load','max_maned','fleet_id'
    ];

    public function fleet(){
    	return $this->belongsTo('App\Fleet');
    }

    public function driver(){
    	return $this->belongsToMany('App\Driver','driver_car');
    }
}
