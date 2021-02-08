<?php

namespace App\Policies;

use App\Request;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function view(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, \App\Assignment $assignment)
    {
        $isUser = $user->belongsToRoles('user');
        $userHasAlreadySent = $isUser && $assignment->requests()->whereHas('user', function ($query) use ($user) {
            $query->where('id', '=', $user->id);
        })->first()->exists();
        $assignmentHasAnswer = $assignment->answers()->first()->exists();

        return $isUser && !$assignmentHasAnswer;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function update(User $user, Request $request)
    {
        $isUser = $user->belongsToRoles('user');
        $isEditorOrAdmin = $user->belongsToRoles('editor', 'admin');

        $hasResponse = $request->requestResponse()->exists();

        return ($isUser && !$hasResponse) || $isEditorOrAdmin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function delete(User $user, Request $request)
    {
        $isUser = $user->belongsToRoles('user');
        $isEditorOrAdmin = $user->belongsToRoles('editor', 'admin');

        $hasResponse = $request->requestResponse()->exists();

        return ($isUser && !$hasResponse) || $isEditorOrAdmin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function restore(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function forceDelete(User $user, Request $request)
    {
        //
    }
}
