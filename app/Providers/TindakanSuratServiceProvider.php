<?php

namespace App\Providers;

use App\Helpers\TindakanSurat;
use Illuminate\Support\ServiceProvider;

class TindakanSuratServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        define('TIDAK_TERUSKAN', TindakanSurat::TIDAK_TERUSKAN);
        define('REVISI', TindakanSurat::REVISI);
        define('TERUSKAN', TindakanSurat::TERUSKAN);
        define('TINDAK_LANJUT', TindakanSurat::TINDAK_LANJUT);
        define('DISPOSISI', TindakanSurat::DISPOSISI);
        define('SELESAI', TindakanSurat::SELESAI);

        view()->composer('*', function ($view) {
            $view->with('tindakanSurat', new TindakanSurat());
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