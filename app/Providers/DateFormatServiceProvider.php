<?php

namespace App\Providers;

use App\Helpers\DateFormat;
use Illuminate\Support\ServiceProvider;

class DateFormatServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            $view->with('dateFormat', new DateFormat());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}