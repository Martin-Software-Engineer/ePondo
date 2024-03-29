<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('logged-in', function($user){
            return redirect('login');
        });

        Gate::define('is-admin', function($user){
            return $user->hasAnyRole('Admin');
        });

        Gate::define('is-jobseeker', function($user){
            return $user->hasAnyRole('JobSeeker');
        });

        Gate::define('is-backer', function($user){
            return $user->hasAnyRole('Backer');
        });
    }
}