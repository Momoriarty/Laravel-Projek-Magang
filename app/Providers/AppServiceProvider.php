<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
            $data = Setting::all();
            $settings = [];
            foreach ($data as $key => $value) {
                $settings[$value->setting_kode] = $value->setting_value;
            }

            if ($settings) {
                config(['app.settings' => $settings]);
            } else {
                config(['app.settings' => null]);
            }
        } else {
            config(['app.settings' => null]); // Atau sesuai kebutuhan Anda
        }

        Paginator::useBootstrapFour();
    }
}
