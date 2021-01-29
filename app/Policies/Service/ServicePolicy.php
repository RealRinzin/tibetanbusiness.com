<?php

namespace App\Policies\Service;

use App\User;
use App\Service\ServiceBasicInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any service basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the service basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Service\ServiceBasicInfo  $serviceBasicInfo
     * @return mixed
     */
    public function view(User $user, ServiceBasicInfo $serviceBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can create service basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the service basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Service\ServiceBasicInfo  $serviceBasicInfo
     * @return mixed
     */
    public function update(User $user, ServiceBasicInfo $serviceBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can delete the service basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Service\ServiceBasicInfo  $serviceBasicInfo
     * @return mixed
     */
    public function delete(User $user, ServiceBasicInfo $serviceBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the service basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Service\ServiceBasicInfo  $serviceBasicInfo
     * @return mixed
     */
    public function restore(User $user, ServiceBasicInfo $serviceBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the service basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Service\ServiceBasicInfo  $serviceBasicInfo
     * @return mixed
     */
    public function forceDelete(User $user, ServiceBasicInfo $serviceBasicInfo)
    {
        //
    }
    
    public function service_edit(User $user, ServiceBasicInfo $serviceBasicInfo)
    {
        //
        return $user->id === $serviceBasicInfo->user_id;
    }
}
