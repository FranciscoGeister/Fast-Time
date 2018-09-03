<?php

namespace App\Policies;

use App\User;
use App\Profesional;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfesionalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the profesional.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }

    /**
     * Determine whether the user can create profesionals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the profesional.
     *
     * @param  \App\User  $user
     * @param  \App\Profesional  $profesional
     * @return mixed
     */
    public function update(User $user, Profesional $profesional)
    {
        //
    }

    /**
     * Determine whether the user can delete the profesional.
     *
     * @param  \App\User  $user
     * @param  \App\Profesional  $profesional
     * @return mixed
     */
    public function delete(User $user, Profesional $profesional)
    {
        //
    }
}
