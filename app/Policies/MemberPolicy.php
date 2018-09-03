<?php

namespace App\Policies;

use App\User;
use App\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function view(User $user, Member $member)
    {
        //
    }

    /**
     * Determine whether the user can create members.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      if (
        $user->hasRole("Administrador Master") or
        $user->hasRole("Administrador Contratado") or
        $user->hasRole("Asistente")
      ){
        return True;
      }
      return False;
    }

    /**
     * Determine whether the user can update the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function update(User $user, Member $member)
    {
        if(
          $user->hasRole("Administrador Master") or
          $user->hasRole("Administrador Contratado") or
          $user->hasRole("Asistente")
        ){
          return True;
        }
        return False;
    }

    /**
     * Determine whether the user can delete the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function delete(User $user, Member $member)
    {
      if(
        $user->hasRole("Administrador Master") or
        $user->hasRole("Administrador Contratado")
      ){
        return True;
      }
      return False;
    }
}
