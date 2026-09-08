<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\VisitorTrackerService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production') || str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

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

        View::composer('layouts.public', function ($view) {
            try {
                $stats = VisitorTrackerService::getRealVisitorStats();
                $view->with('visitorStats', $stats);
            } catch (\Throwable $e) {
                $view->with('visitorStats', [
                    'today' => 1,
                    'yesterday' => 0,
                    'this_month' => 1,
                    'total_visitors' => 1,
                    'total_hits' => 1,
                    'online' => 1,
                ]);
            }
        });
    }
}
