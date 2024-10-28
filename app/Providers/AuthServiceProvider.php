<?php

namespace App\Providers;

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

        Gate::define('view-all', function ($user) {
            return true; 
        });

        Gate::define('view-surat-masuk', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('sekretaris');
        });

        Gate::define('view-admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('view-all', function ($user) {
            return true; 
        });
    
    }
}
