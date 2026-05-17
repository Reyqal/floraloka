<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User; 
use Illuminate\Support\Facades\Gate; 
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('admin-access', function (User $user) {
            if ($user->role === 'admin') { 
                return true;
            }
            return false;
        });
    }
}
