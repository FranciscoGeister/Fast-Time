<?php

namespace App\Policies;

use App\User;
use App\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the notification.
     *
     * @param  \App\User  $user
     * @param  \App\Notification  $notification
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->hasRole("Administrador Master") or
                $user->hasRole("Administrador Contratado"));
    }

    /**
     * Determine whether the user can create notifications.
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
     * Determine whether the user can update the notification.
     *
     * @param  \App\User  $user
     * @param  \App\Notification  $notification
     * @return mixed
     */
    public function update(User $user, Notification $notification)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }

    /**
     * Determine whether the user can delete the notification.
     *
     * @param  \App\User  $user
     * @param  \App\Notification  $notification
     * @return mixed
     */
    public function delete(User $user, Notification $notification)
    {
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }

    public function send(User $user){
      return ($user->hasRole("Administrador Master") or
              $user->hasRole("Administrador Contratado"));
    }
}
