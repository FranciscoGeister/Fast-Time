<?php

namespace App\Policies;

use App\User;
use App\PersonalFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalFilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the personalFile.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalFile  $personalFile
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->hasRole("Administrador Master") or
                $user->hasRole("Administrador Contratado") or
                $user->hasRole("Asistente") or
                $user->hasRole("Entrenador") or
                $user->hasRole("Gerente Técnico"));
    }

    /**
     * Determine whether the user can create personalFiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the personalFile.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalFile  $personalFile
     * @return mixed
     */
    public function update(User $user, PersonalFile $personalFile)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado") or
              $user->hasRole("Asistente") or
              $user->hasRole("Entrenador") or
              $user->hasRole("Gerente Técnico"));
    }

    /**
     * Determine whether the user can delete the personalFile.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalFile  $personalFile
     * @return mixed
     */
    public function delete(User $user, PersonalFile $personalFile)
    {
        //
    }
}
