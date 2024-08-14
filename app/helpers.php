<?php

use App\Classes\Cart;
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
                'default' => false,
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'flag' => 'us',
                'direction' => 'ltr',
                'default' => true,
            ],
        ];
    }
}

if (! function_exists('localized_url')) {
    function localized_url($locale, $url = null)
    {
        $default = collect(locales(false))->where('code', $locale)->first()['default'] ?? false;

        if ($url) {
            $url = optional(parse_url($url))['path'] ?: '/';
        } else {
            $url = request()->getRequestUri();
        }

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

if (! function_exists('html')) {
    function html($tiptap_content)
    {
        return $tiptap_content ? tiptap_converter()->asHTML($tiptap_content) : '';
    }
}

if (! function_exists('text')) {
    function text($tiptap_content)
    {
        return $tiptap_content ? tiptap_converter()->asText($tiptap_content) : '';
    }
}

if (! function_exists('cart')) {
    function cart($items = null)
    {
        $cart = new Cart;

        if ($items) {
            $cart->items = $items;
        }

        return $cart;
    }
}

if (! function_exists('schema_text')) {
    function schema_text($text, ?int $limit = null)
    {
        $text = trim(strip_tags($text));

        $text = html_entity_decode($text);

        $text = str_replace(["\u{A0}", "\r\n", "\n"], ' ', $text);

        // Replace multiple spaces with single space
        $text = preg_replace('!\s+!', ' ', $text);

        if ($limit) {
            $text = str()->limit($text, $limit);
        }

        $text = addslashes($text);

        $text = str_replace("\'", "'", $text);

        return $text;
    }
}
