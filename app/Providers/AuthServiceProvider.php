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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit-teachers', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-teachers', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit-students', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-students', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('create-classes', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit-classes', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-classes', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('create-subjects', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit-subjects', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-subjects', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('manage-marks', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('create-marks', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('edit-marks', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('delete-marks', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('show-marks', function($user){
            return $user->hasRole('student');
        });

        Gate::define('manage-events', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('create-events', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('edit-events', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('delete-events', function($user){
            return $user->hasAnyRoles(['admin', 'teacher']);
        });

        Gate::define('show-events', function($user){
            return $user->hasRole('student');
        });
    }
}
