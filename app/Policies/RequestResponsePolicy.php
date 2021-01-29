<?php

namespace App\Policies;

use App\RequestResponse;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\RequestResponse  $requestResponse
     * @return mixed
     */
    public function view(User $user, RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $isAdmin = $user->belongsToRoles('admin');
        $isEditor = $user->belongsToRoles('editor');
        
        return $isAdmin || $isEditor;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\RequestResponse  $requestResponse
     * @return mixed
     */
    public function update(User $user, RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\RequestResponse  $requestResponse
     * @return mixed
     */
    public function delete(User $user, RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\RequestResponse  $requestResponse
     * @return mixed
     */
    public function restore(User $user, RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\RequestResponse  $requestResponse
     * @return mixed
     */
    public function forceDelete(User $user, RequestResponse $requestResponse)
    {
        //
    }
}
