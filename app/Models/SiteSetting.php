<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Retrieve a setting value by key with fallback default.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if ($setting && $setting->value !== null && $setting->value !== '') {
                return $setting->value;
            }
            return $default;
        });
    }

    /**
     * Retrieve setting for default locale (id) or fallback to translation for other locales.
     */
    public static function getLocalized(string $key, string $translationKey): string
    {
        if (app()->getLocale() === 'id') {
            $val = static::get($key);
            if (!empty($val)) {
                return $val;
            }
        }

        return __($translationKey);
    }

    /**
     * Set or update a setting value.
     */
    public static function set(string $key, ?string $value, ?string $description = null): static
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description ?? $key,
            ]
        );

        Cache::forget("site_setting_{$key}");

        return $setting;
    }
}
