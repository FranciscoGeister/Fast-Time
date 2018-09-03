<?php

namespace App\Policies;

use App\User;
use App\EvaluationSession;
use Illuminate\Auth\Access\HandlesAuthorization;

class EvaluationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the evaluationSession.
     *
     * @param  \App\User  $user
     * @param  \App\EvaluationSession  $evaluationSession
     * @return mixed
     */
    public function view(User $user, EvaluationSession $evaluationSession)
    {
        //
    }

    /**
     * Determine whether the user can create evaluationSessions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !($user->hasRole("Asistente") or
                 $user->hasRole("Gerente Técnico"));
    }

    /**
     * Determine whether the user can update the evaluationSession.
     *
     * @param  \App\User  $user
     * @param  \App\EvaluationSession  $evaluationSession
     * @return mixed
     */
    public function update(User $user, EvaluationSession $evaluationSession)
    {
        //
    }

    /**
     * Determine whether the user can delete the evaluationSession.
     *
     * @param  \App\User  $user
     * @param  \App\EvaluationSession  $evaluationSession
     * @return mixed
     */
    public function delete(User $user, EvaluationSession $evaluationSession)
    {
        //
    }
}
