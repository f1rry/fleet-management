<?php

namespace App\Policies;

use App\User;
use App\Driver;
use App\Car;
use Illuminate\Auth\Access\HandlesAuthorization;
use DB;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    protected $modiyf_driver_level=3;

    public function __construct()
    {
        //

    }

    public function before(User $user){
        return $user->isSuperAdmin()?true:null;
    }

    public function show(User $user){
        return $user->isFleetAdmin()||$user->isDriver();
    }

    public function add(User $user){
        return $user->isFleetAdmin()||$user->isDriver();
    }

    public function update(User $user,Car $car){
        return ($user->isFleetAdmin()&&($user->fleet_id===$car->fleet_id))||
               (($user->isDriver())&&
                (DB::table('driver_car')
                    ->where('driver_id','=',$user->driver_id)
                    ->where('car_id','=',$car->id)->first()));
    }

    public function delete(User $user,Car $car){
        return ($user->isFleetAdmin()&&($user->fleet_id===$car->fleet_id))||
               (($user->isDriver())&&
                (DB::table('driver_car')
                    ->where('driver_id','=',$user->driver_id)
                    ->where('car_id','=',$car->id)->first()));
    }
}
