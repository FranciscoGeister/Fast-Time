<?php

namespace App\Policies;

use App\User;
use App\SessionTab;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
{
    use HandlesAuthorization;


    public function index(User $user){
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Entrenador") or
              $user->hasRole("Gerente Técnico"));
    }

    /**
     * Determine whether the user can view the sessionTab.
     *
     * @param  \App\User  $user
     * @param  \App\SessionTab  $sessionTab
     * @return mixed
     */
    public function view(User $user, SessionTab $sessionTab)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Entrenador") or
              $user->hasRole("Gerente Técnico"));
    }

    /**
     * Determine whether the user can create sessionTabs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Entrenador") or
              $user->hasRole("Gerente Técnico"));
    }

    /**
     * Determine whether the user can update the sessionTab.
     *
     * @param  \App\User  $user
     * @param  \App\SessionTab  $sessionTab
     * @return mixed
     */
    public function update(User $user, SessionTab $sessionTab)
    {
        //
    }

    /**
     * Determine whether the user can delete the sessionTab.
     *
     * @param  \App\User  $user
     * @param  \App\SessionTab  $sessionTab
     * @return mixed
     */
    public function delete(User $user, SessionTab $sessionTab)
    {
        //
    }
}
