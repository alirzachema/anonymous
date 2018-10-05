<?php

namespace App\Providers;

use App\Role;
use App\User;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: User actions
        Gate::define('user_action_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Business management
        Gate::define('business_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Companies
        Gate::define('company_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Company categories
        Gate::define('company_category_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_category_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('company_category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Products
        Gate::define('product_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Product categories
        Gate::define('product_category_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_category_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Product tags
        Gate::define('product_tag_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_tag_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_tag_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_tag_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_tag_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Locations
        Gate::define('location_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: States
        Gate::define('state_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('state_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('state_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('state_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('state_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Cities
        Gate::define('city_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
