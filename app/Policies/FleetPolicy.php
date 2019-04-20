<?php

namespace App\Policies;

use App\User;
use App\Fleet;
use Illuminate\Auth\Access\HandlesAuthorization;

class FleetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    protected $modify_fleet_level=1;

    public function __construct()
    {
        //
    }

    public function before(User $user){
        return $user->isSuperAdmin()?true:null;
    }

    public function show(User $user){

    }

    public function add(User $user ,Fleet $fleet){
        return $user->id===$fleet->user_id;
    }

    public function delete(User $user,Fleet $fleet){
        return $user->id===$fleet->user_id;
    }

    public function update(User $user,Fleet $fleet){
        return $user->id===$fleet->user_id;
    }
}
