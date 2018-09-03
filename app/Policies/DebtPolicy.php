<?php

namespace App\Policies;

use App\User;
use App\MemberDebt;
use Illuminate\Auth\Access\HandlesAuthorization;

class DebtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the memberDebt.
     *
     * @param  \App\User  $user
     * @param  \App\MemberDebt  $memberDebt
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->hasRole("Administrador Master") or
                $user->hasRole("Administrador Contratado") or
                $user->hasRole("Asistente"));
    }

    /**
     * Determine whether the user can create memberDebts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Asistente"));
    }

    /**
     * Determine whether the user can update the memberDebt.
     *
     * @param  \App\User  $user
     * @param  \App\MemberDebt  $memberDebt
     * @return mixed
     */
    public function update(User $user, MemberDebt $memberDebt)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Asistente"));
    }

    /**
     * Determine whether the user can delete the memberDebt.
     *
     * @param  \App\User  $user
     * @param  \App\MemberDebt  $memberDebt
     * @return mixed
     */
    public function delete(User $user, MemberDebt $memberDebt)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Asistente"));
    }
}
