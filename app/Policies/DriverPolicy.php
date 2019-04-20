<?php

namespace App\Policies;

use App\User;
use App\Fleet;
use App\Driver;
use Illuminate\Auth\Access\HandlesAuthorization;

class DriverPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    public function before(User $user){
        return $user->isSuperAdmin()?true:null;
    }

    public function show(User $user){
        return $user->isFleetAdmin();
    }

    public function add(User $user){
        return $user->isFleetAdmin();
    }

    public function update(User $user,Driver $driver){
        return $user->isFleetAdmin()
        &&(Fleet::where('id','=',$driver->fleet_id)->first()->user_id===$user->id);
    }

    public function delete(User $user,Driver $driver){
        return $user->isFleetAdmin()
        &&(Fleet::where('id','=',$driver->fleet_id)->first()->user_id===$user->id);
    }
}
