<?php

namespace App\Policies;

use App\User;
use App\Event\EventBasicInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventEventPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any event basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the event basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Event\EventBasicInfo  $eventBasicInfo
     * @return mixed
     */
    public function view(User $user, EventBasicInfo $eventBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can create event basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the event basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Event\EventBasicInfo  $eventBasicInfo
     * @return mixed
     */
    public function update(User $user, EventBasicInfo $eventBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can delete the event basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Event\EventBasicInfo  $eventBasicInfo
     * @return mixed
     */
    public function delete(User $user, EventBasicInfo $eventBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the event basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Event\EventBasicInfo  $eventBasicInfo
     * @return mixed
     */
    public function restore(User $user, EventBasicInfo $eventBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the event basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Event\EventBasicInfo  $eventBasicInfo
     * @return mixed
     */
    public function forceDelete(User $user, EventBasicInfo $eventBasicInfo)
    {
        //
    }
}
