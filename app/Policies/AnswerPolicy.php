<?php

namespace App\Policies;

use App\Answer;
use App\User;
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
        $admin_role_name = \App\Role::where('name', '=', 'admin')->get()->first()->name;
        $editor_role_name = \App\Role::where('name', '=', 'editor')->get()->first()->name;

        foreach ($user->roles()->get() as $role)
        {
            if ($role->name == $admin_role_name || $role->name == $editor_role_name)
            {
                return true;
            }
        }

        return false;
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
        $admin_role_name = \App\Role::where('name', '=', 'admin')->get()->first()->name;
        $editor_role_name = \App\Role::where('name', '=', 'editor')->get()->first()->name;

        $isAdmin = false;
        $owns = false;

        foreach ($user->roles()->get() as $role)
        {
            if ($role->name == $admin_role_name)
            {
                $isAdmin = true;
            }
            else if ($role->name == $editor_role_name)
            {
                $owns = $user->id == $answer->user_id;
            }
        }

        return $isAdmin || $owns;
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
        $admin_role_name = \App\Role::where('name', '=', 'admin')->get()->first()->name;
        $editor_role_name = \App\Role::where('name', '=', 'editor')->get()->first()->name;

        $isAdmin = false;
        $owns = false;

        foreach ($user->roles()->get() as $role)
        {
            if ($role->name == $admin_role_name)
            {
                $isAdmin = true;
            }
            else if ($role->name == $editor_role_name)
            {
                $owns = $user->id == $answer->user_id;
            }
        }

        return $isAdmin || $owns;
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
