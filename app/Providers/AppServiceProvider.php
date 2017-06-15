<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        View::share('isAuth', true);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        //TODO link helper class or create HelperServiceProvider
    }
}
