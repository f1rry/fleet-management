<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    //
    protected $fillable = [
        'fleet_name','status','user_id',
    ];

    public function car(){
    	return $this->hasMany('App\Car');
    }

    public function user(){
        $this->belongsTo('App\User');
    }
}
