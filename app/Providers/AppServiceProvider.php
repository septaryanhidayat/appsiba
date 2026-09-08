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
                    $settings = Setting::pluck('value', 'key')->toArray();

                    $resolveUrl = function (?string $val, string $default): string {
                        if (empty($val)) {
                            return asset($default);
                        }
                        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
                            return $val;
                        }
                        if (str_starts_with($val, 'assets/')) {
                            return asset($val);
                        }
                        $clean = ltrim(str_replace('storage/', '', $val), '/');
                        if (file_exists(public_path('storage/'.$clean)) || file_exists(storage_path('app/public/'.$clean))) {
                            return asset('storage/'.$clean);
                        }
                        if (file_exists(public_path($clean))) {
                            return asset($clean);
                        }

                        return asset($default);
                    };

                    $settings['logo_url'] = $resolveUrl($settings['logo'] ?? null, 'assets/images/appsi-logo.png');
                    $settings['favicon_url'] = $resolveUrl($settings['favicon'] ?? null, 'assets/images/appsi-logo.png');
                    $settings['og_image_url'] = $resolveUrl($settings['og_image'] ?? null, 'assets/images/appsi-logo.png');
                    $settings['hero_image_url'] = $resolveUrl($settings['hero_image'] ?? null, 'assets/images/ketua-hero.webp');
                    $settings['foto_ketua_profil_url'] = $resolveUrl($settings['foto_ketua_profil'] ?? null, 'assets/images/ketua-appsi-banyuasin.webp');
                    $settings['foto_ketua_semangat_url'] = $resolveUrl($settings['foto_ketua_semangat'] ?? null, 'assets/images/ketua-semangat.webp');

                    return $settings;
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
