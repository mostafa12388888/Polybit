<?php

use App\Models\Setting;

if (! function_exists('direction')) {
    function direction()
    {
        return request()->dir == 'rtl' ? 'rtl' : 'ltr';
    }
}

if (! function_exists('locales')) {
    function locales()
    {
        return [
            'ar' => 'العربية',
            'en' => 'English',
        ];
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

        $settings = Setting::whereNull('user_id')->with('media')->get();

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
