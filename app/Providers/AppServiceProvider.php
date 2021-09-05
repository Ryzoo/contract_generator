<?php

namespace App\Providers;

use App\Guards\TokenGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Auth::extend('access_token', function ($app, $name) {
            $userProvider = app(TokenToUserProvider::class);
            $request = app('request');
            return new TokenGuard($userProvider, $request);
        });
    }
}
