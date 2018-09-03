<?php

namespace App\Providers;
use App\Policies\MemberPolicy;
use App\Policies\ProfesionalPolicy;
use App\Policies\ProductPolicy;
use App\Policies\HoraPolicy;
use App\Policies\DebtPolicy;
use App\Policies\SessionPolicy;
use App\Policies\PersonalFilePolicy;
use App\Policies\EvaluationPolicy;
use App\Policies\CampaignPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\MachinePolicy;
use App\Member;
use App\Profesional;
use App\Product;
use App\Hora;
use App\MemberDebt;
use App\SessionTab;
use App\PersonalFile;
use App\EvaluationSession;
use App\Campaign;
use App\Notification;
use App\Machine;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Member::class => MemberPolicy::class,
        Profesional::class => ProfesionalPolicy::class,
        Product::class => ProductPolicy::class,
        Hora::class => HoraPolicy::class,
        MemberDebt::class => DebtPolicy::class,
        SessionTab::class => SessionPolicy::class,
        PersonalFile::class => PersonalFilePolicy::class,
        EvaluationSession::class => EvaluationPolicy::class,
        Campaign::class => CampaignPolicy::class,
        Notification::class => NotificationPolicy::class,
        Machine::class => MachinePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-parameter', function($user) {
          return ($user->hasRole("Administrador Master") or
                  $user->hasRole("Administrador Contratado") );
        });
    }
}
