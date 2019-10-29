<?php

namespace App\Providers;

use App\Guards\TokenGuard;
use App\Core\Models\AppAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('access_token', function ($app, $name) {
            $userProvider = app(TokenToUserProvider::class);
            $request = app('request');
            return new TokenGuard($userProvider, $request);
        });
    }
}
