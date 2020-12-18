<?php

namespace App\Policies;

use App\Assignment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
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
        // todo: if is an admin, editor or just someone who bought the subscription

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function view(User $user, Assignment $assignment)
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
        // todo: if is an admin, editor or just someone who bought the subscription

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function update(User $user, Assignment $assignment)
    {
        $admin_role_name = \App\Role::where('name', '=', 'admin')->get()->first()->name;

        $isAdmin = false;
        $owns = false;
        $hasAnswer = $assignment->answers()->exists();

        foreach ($user->roles()->get() as $role)
        {
            if ($role->name == $admin_role_name)
            {
                $isAdmin = true;
            }
            else
            {
                $owns = $user->id == $assignment->user_id;
            }
        }

        return $isAdmin || ($owns && !$hasAnswer);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function delete(User $user, Assignment $assignment)
    {
        $admin_role_name = \App\Role::where('name', '=', 'admin')->get()->first()->name;

        $isAdmin = false;
        $owns = false;
        $hasAnswer = $assignment->answers()->exists();

        foreach ($user->roles()->get() as $role)
        {
            if ($role->name == $admin_role_name)
            {
                $isAdmin = true;
            }
            else
            {
                $owns = $user->id == $assignment->user_id;
            }
        }

        return $isAdmin || ($owns && !$hasAnswer);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function restore(User $user, Assignment $assignment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function forceDelete(User $user, Assignment $assignment)
    {
        //
    }
}
