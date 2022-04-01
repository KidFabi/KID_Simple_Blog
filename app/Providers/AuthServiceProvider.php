<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define whether the user can access the dashboard.
        Gate::define('access-dashboard', function($user) {
            return $user->isAdministrator()
                || $user->isEditor()
                || $user->isAuthor();
        });

        // Define whether the user can see statistics on the dashboard.
        Gate::define('see-dashboard-statistics', function($user) {
            return $user->isAdministrator()
                || $user->isEditor();
        });
    }
}
