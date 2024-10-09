<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\marriagesModel;
use App\Policies\MarriagePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        marriagesModel::class => MarriagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isSuper', function($user){
            return $user->role == 'super_admin';
        });

        Gate::define('isAdmin', function($user){
            return $user->role == 'admin' || $user->role == 'super_admin';
        });

        Gate::define('isMasjid', function($user){
            return $user->role == 'masjid' || $user->role == 'admin' || $user->role == 'super_admin';
        });

        Gate::define('isHusband', function($user){
            return $user->role == 'super_admin' || $user->role == 'admin' || $user->role == 'masjid' || $user->role == 'husband';
        });

        Gate::define('isWife', function($user){
            return $user->role == 'super_admin' || $user->role == 'admin' || $user->role == 'masjid' || $user->role == 'wife';
        });

        Gate::define('isCouple', function($user){
            return $user->role == 'super_admin' || $user->role == 'admin' || $user->role == 'masjid' || $user->role == 'husband' || $user->role == 'wife';
        });
    }
}
