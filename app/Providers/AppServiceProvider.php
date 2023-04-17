<?php

namespace App\Providers;

use Illuminate\Support\Facedes\URL;
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
        //if(env(key: 'APP_ENV') !=='local') {
        //    URL::forceScheme(scheme:'https');
        //}
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if (env( key: 'APP_ENV') !== 'local') {
        //     URL::forceScheme( scheme: 'https');
        // }
        // \Illuminate\Support\Facades\URL::forceScheme('https');
        // if (env('APP_ENV') === 'production') {
        //     \Illuminate\Support\Facades\URL::forceScheme('https');
        // }
        if(config('app.debug')!=true) {
            \URL::forceScheme('https');
          }
    }
}
