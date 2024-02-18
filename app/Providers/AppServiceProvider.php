<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            // Jika tabel 'settings' ada, ambil data dari tabel
            $settings = Setting::where('status', 1)->first();
            // Set konfigurasi app.settings jika data ditemukan
            if ($settings) {
                config(['app.settings' => $settings]);
            } else {
                // Tabel ada tetapi tidak ada data yang sesuai
                // Lakukan tindakan yang sesuai, seperti memberikan nilai default ke konfigurasi
                config(['app.settings' => null]); // Atau sesuai kebutuhan Anda
            }
        } else {
            // Tabel 'settings' tidak ada dalam database
            // Lakukan tindakan yang sesuai, seperti memberikan nilai default ke konfigurasi
            config(['app.settings' => null]); // Atau sesuai kebutuhan Anda
        }
    }
}
