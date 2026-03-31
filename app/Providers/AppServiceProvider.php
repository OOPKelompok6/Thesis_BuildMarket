<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //Role checkers
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('isUser', function (User $user) {
            return $user->role === 'User';
        });

        Gate::define('isSeller', function (User $user) {
            return $user->role === 'Seller';
        });
        //Role checkers --end
    }
}
