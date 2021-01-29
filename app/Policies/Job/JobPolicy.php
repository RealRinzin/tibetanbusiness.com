<?php

namespace App\Policies\Job;

use App\User;
use App\Job\JobBasicInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any job basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the job basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Job\JobBasicInfo  $jobBasicInfo
     * @return mixed
     */
    public function view(User $user, JobBasicInfo $jobBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can create job basic infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the job basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Job\JobBasicInfo  $jobBasicInfo
     * @return mixed
     */
    public function update(User $user, JobBasicInfo $jobBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can delete the job basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Job\JobBasicInfo  $jobBasicInfo
     * @return mixed
     */
    public function delete(User $user, JobBasicInfo $jobBasicInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the job basic info.
     *
     * @param  \App\User  $user
     * @param  \App\Job\JobBasicInfo  $jobBasicInfo
     * @return mixed
     */
    public function restore(User $user, JobBasicInfo $jobBasicInfo)
    {
        //
    }
    // Edit Authorization for Job
    public function job_edit(User $user, JobBasicInfo $jobBasicInfo)
    {
        //
        return $user->id === $jobBasicInfo->user_id;
    }
}
