<?php

namespace App\Policies;

use App\Answer;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
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
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function view(User $user, Answer $answer)
    {
        // answer belongs to the user
        // answer from user's request - if he paid for it
        // normal answer - if user has bought a plan and it's valid

        if ($user->belongsToRoles('admin', 'editor'))
        {
            return true;
        }

        if ($answer->user_id == $user->id)
        {
            return true;
        }

        if ($answer->requestResponse()->exists() && $answer->requestResponse->paid)
        {
            return true;
        }

        if ($answer->accepted == false)
        {
            return false;
        }
        
        if ($user->has_access_to_date == null)
        {
            return false;
        }

        $today = Carbon::now();
        $accessDate = Carbon::createFromFormat('Y-m-d', $user->has_access_to_date);

        if ($accessDate->lte($today))
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        $isAdmin = $user->belongsToRoles('admin');
        $isEditor = $user->belongsToRoles('editor');
        
        $owns = $user->id == $answer->user_id;

        return $isAdmin || ($isEditor && $owns);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        $isAdmin = $user->belongsToRoles('admin');
        $isEditor = $user->belongsToRoles('editor');

        $owns = $user->id == $answer->user_id;

        return $isAdmin || ($isEditor && $owns);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function restore(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function forceDelete(User $user, Answer $answer)
    {
        //
    }
}
