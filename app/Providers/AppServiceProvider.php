<?php

namespace App\Providers;

use App\Models\AppAuthorization;
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
        $this->app->bind('path.public', function() {
          return base_path('public_html');
        });

        $this->app->singleton('AppAuthorization', function () {
            return new AppAuthorization();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
