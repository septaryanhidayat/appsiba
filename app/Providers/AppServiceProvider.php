<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            try {
                $webSetting = Cache::remember('web_settings_global', 3600, function () {
                    return Setting::pluck('value', 'key')->toArray();
                });
                $view->with('webSetting', $webSetting);
            } catch (\Throwable $e) {
                $view->with('webSetting', []);
            }
        });
    }
}
