<?php

namespace App\Providers;

use App\Core\Services\Contract\ContractModuleService;
use App\Guards\TokenGuard;
use App\Core\Models\AppAuthorization;
use App\Jobs\RenderContract;
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
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
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
