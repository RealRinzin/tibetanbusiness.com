<?php

namespace App\Policies\Rent;

use App\Rent\RentBasicInfo as RentRentBasicInfo;
use App\User;
use App\RentBasicInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class RentPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any rent basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the rent basic info.
     *
     * @param  \App\User  $user
     * @param  \App\RentBasicInfo  $rentBasicInfo
     * @return mixed
     */
    public function view(User $user, RentBasicInfo $rentBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can create rent basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the rent basic info.
     *
     * @param  \App\User  $user
     * @param  \App\RentBasicInfo  $rentBasicInfo
     * @return mixed
     */
    public function update(User $user, RentBasicInfo $rentBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can delete the rent basic info.
     *
     * @param  \App\User  $user
     * @param  \App\RentBasicInfo  $rentBasicInfo
     * @return mixed
     */
    public function delete(User $user, RentBasicInfo $rentBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the rent basic info.
     *
     * @param  \App\User  $user
     * @param  \App\RentBasicInfo  $rentBasicInfo
     * @return mixed
     */
    public function restore(User $user, RentBasicInfo $rentBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the rent basic info.
     *
     * @param  \App\User  $user
     * @param  \App\RentBasicInfo  $rentBasicInfo
     * @return mixed
     */
    public function forceDelete(User $user, RentBasicInfo $rentBasicInfo)
    {
        //
    }
    public function rent_auth(User $user, RentRentBasicInfo $rentBasicInfo)
    {
        //
        return $user->id === $rentBasicInfo->user_id;
    }
}
