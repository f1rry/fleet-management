<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Fleet;
use App\Driver;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','pri_level','fleet_id','driver_id','access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findForPassport($username){
        return $this->where('email', $username)->first();
    }

    public function fleet(){
        return $this->hasOne('App\Fleet');
    }

    public function driver(){
        return $this->hasOne('App\Driver');
    }

    public function isSuperAdmin(){
        return $this->pri_level===1;
    }

    public function isFleetAdmin(){
        return $this->pri_level===2;
    }

    public function isDriver(){
        return $this->pri_level===3;
    }
}
