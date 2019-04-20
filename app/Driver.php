<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = [
        'name','old','sex','status','user_id','fleet_id',
    ];
    
    public function fleet(){
    	return $this->belongsTo('App\Fleet');
    }

    public function car(){
    	return $this->belongsToMany('App\Car','driver_car');
    }

    public function user(){
        $this->hasOne('App\User');
    }
}
