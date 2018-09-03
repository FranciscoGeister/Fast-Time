<?php

namespace App\Policies;

use App\User;
use App\Hora;
use Illuminate\Auth\Access\HandlesAuthorization;

class HoraPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the hora.
     *
     * @param  \App\User  $user
     * @param  \App\Hora  $hora
     * @return mixed
     */
    public function view(User $user, Hora $hora)
    {
        //
    }

    /**
     * Determine whether the user can create horas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->hasRole('Administrador Master') or
                $user->hasRole('Administrador Contratado') or
                $user->hasRole('Asistente'));
    }

    /**
     * Determine whether the user can update the hora.
     *
     * @param  \App\User  $user
     * @param  \App\Hora  $hora
     * @return mixed
     */
    public function update(User $user, Hora $hora)
    {
        //
    }

    /**
     * Determine whether the user can delete the hora.
     *
     * @param  \App\User  $user
     * @param  \App\Hora  $hora
     * @return mixed
     */
    public function delete(User $user, Hora $hora)
    {
        //
    }
}
