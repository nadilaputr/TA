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
        define('DITERIMA', TindakanSurat::DITERIMA);
        define('REVISI', TindakanSurat::REVISI);
        define('MENUNGGU_INSTRUKSI_KEPALA', TindakanSurat::MENUNGGU_INSTRUKSI_KEPALA);
        define('DISPOSISI', TindakanSurat::DISPOSISI);
        define('TINDAK_LANJUT', TindakanSurat::TINDAK_LANJUT);
        define('ARSIP', TindakanSurat::ARSIP);
        define('TELAH_DIREVISI', TindakanSurat::TELAH_DIREVISI);

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
