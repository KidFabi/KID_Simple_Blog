<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the authenticated user can view the users manager page.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdministrator()
            || $user->isEditor();
    }

    /**
     * Determine whether the authenticated user can view the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->isAdministrator()
            || $user->isEditor();
    }

    /**
     * Determine whether the authenticated user can update the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the authenticated user can view sensitive data of the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewSensitiveData(User $user, User $target)
    {
        return $user->id === $target->id
            || $user->isAdministrator();
    }

    /**
     * Determine whether the authenticated user can disable and enable comments for the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function disableEnableComments(User $user)
    {
        return $user->isAdministrator()
            || $user->isEditor();
    }
}
