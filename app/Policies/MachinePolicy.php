<?php

namespace App\Policies;

use App\User;
use App\Machine;
use Illuminate\Auth\Access\HandlesAuthorization;

class MachinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the machine.
     *
     * @param  \App\User  $user
     * @param  \App\Machine  $machine
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->hasRole("Administrador Master") or
                $user->hasRole("Administrador Contratado"));
    }

    /**
     * Determine whether the user can create machines.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }

    /**
     * Determine whether the user can update the machine.
     *
     * @param  \App\User  $user
     * @param  \App\Machine  $machine
     * @return mixed
     */
    public function update(User $user, Machine $machine)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }

    /**
     * Determine whether the user can delete the machine.
     *
     * @param  \App\User  $user
     * @param  \App\Machine  $machine
     * @return mixed
     */
    public function delete(User $user, Machine $machine)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }
}
