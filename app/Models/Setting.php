<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, ?string $value): self
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Resolves a public asset or storage URL for setting key cleanly.
     */
    public static function imageUrl(string $key, string $default): string
    {
        $val = static::get($key);
        if (empty($val)) {
            return asset($default);
        }

        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
            return $val;
        }

        if (str_starts_with($val, 'assets/')) {
            return asset($val);
        }

        $cleanPath = ltrim(str_replace('storage/', '', $val), '/');

        if (file_exists(public_path('storage/'.$cleanPath)) || file_exists(storage_path('app/public/'.$cleanPath))) {
            return asset('storage/'.$cleanPath);
        }

        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        return asset($default);
    }
}
