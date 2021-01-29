<?php

namespace App\Policies\Restaurant;

use App\User;
use App\Restaurant\RestaurantBasicInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any restaurant basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can view the restaurant basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant\RestaurantBasicInfo  $restaurantBasicInfo
     * @return mixed
     */
    public function view(User $user, RestaurantBasicInfo $restaurantBasicInfo)
    {
        //
        return $user->id === $restaurantBasicInfo->user_id;
    }

    /**
     * Determine whether the user can update the restaurant basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant\RestaurantBasicInfo  $restaurantBasicInfo
     * @return mixed
     */
    public function update(User $user, RestaurantBasicInfo $restaurantBasicInfo)
    {
        //
        return $user->id == $restaurantBasicInfo->user->id;
    }

    /**
     * Determine whether the user can delete the restaurant basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant\RestaurantBasicInfo  $restaurantBasicInfo
     * @return mixed
     */
    public function delete(User $user, RestaurantBasicInfo $restaurantBasicInfo)
    {
        //
        return $user->id == $restaurantBasicInfo->user->id;

    }
    
    public function restaurant_edit(User $user, RestaurantBasicInfo $restaurantBasicInfo)
    {
        //
        return $user->id === $restaurantBasicInfo->user_id;
    }
}
