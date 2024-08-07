<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('direction')) {
    function direction()
    {
        return collect(locales(false))->where('code', app()->getLocale())->first()['direction'] ?? 'rtl';
    }
}

if (! function_exists('locales')) {
    function locales($key_value = true)
    {
        return $key_value ? [
            'ar' => 'العربية',
            'en' => 'English',
        ] : [
            [
                'code' => 'ar',
                'name' => 'العربية',
                'flag' => 'eg',
                'direction' => 'rtl',
                'default' => true,
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'flag' => 'us',
                'direction' => 'ltr',
                'default' => false,
            ],
        ];
    }
}

if (! function_exists('localized_url')) {
    function localized_url($locale)
    {
        $default = collect(locales(false))->where('code', $locale)->first()['default'] ?? false;

        $url = request()->getRequestUri();

        if (in_array(request()->segment(1), array_keys(locales()))) {
            $url = substr($url, strlen(request()->segment(1)) + 1);
        }

        if (! $default) {
            $url = $locale.$url;
        }

        return url($url);
    }
}

if (! function_exists('setting')) {
    function setting($key, $default = null, $wants_translation = true)
    {
        if (is_array($key) && count($key) == 1) {
            foreach ($key as $key => $value) {
                if ($key) {
                    Setting::updateOrInsert(['key' => $key], ['value' => is_array($value) ? json_encode($value) : $value]);
                }
            }
        }

        $settings = Cache::remember('settings', 60 * 60, function () {
            return Setting::whereNull('user_id')->with('media')->get();
        });

        foreach (explode('.', $key) as $key) {
            if (! isset($setting)) {
                $setting = optional($settings->where('key', $key)->first())->format($wants_translation)['value'] ?? [];
            } else {
                $setting = optional($setting)[$key];
            }
        }

        return $setting ?: $default;
    }
}
