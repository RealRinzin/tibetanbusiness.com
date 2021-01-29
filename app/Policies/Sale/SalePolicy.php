<?php

namespace App\Policies\Sale;

use App\User;
use App\Sale\SaleBasicInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any sale basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the sale basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Sale\SaleBasicInfo  $saleBasicInfo
     * @return mixed
     */
    public function view(User $user, SaleBasicInfo $saleBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can create sale basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the sale basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Sale\SaleBasicInfo  $saleBasicInfo
     * @return mixed
     */
    public function update(User $user, SaleBasicInfo $saleBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can delete the sale basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Sale\SaleBasicInfo  $saleBasicInfo
     * @return mixed
     */
    public function delete(User $user, SaleBasicInfo $saleBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the sale basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Sale\SaleBasicInfo  $saleBasicInfo
     * @return mixed
     */
    public function restore(User $user, SaleBasicInfo $saleBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sale basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Sale\SaleBasicInfo  $saleBasicInfo
     * @return mixed
     */
    public function forceDelete(User $user, SaleBasicInfo $saleBasicInfo)
    {
        //
    }

    
    public function sale_edit(User $user, SaleBasicInfo $saleBasicInfo)
    {
        //
        return $user->id === $saleBasicInfo->user_id;
    }

}
