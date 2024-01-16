<?php

namespace App\Policies;

use App\Models\Principal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrincipalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return auth()->user()->departement === 'IT' || auth()->user()->departement === 'Finance and Accounting' || auth()->user()->departement === 'Management';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Principal $principal)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Principal $principal)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Principal $principal)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Principal $principal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Principal $principal)
    {
        //
    }
}
